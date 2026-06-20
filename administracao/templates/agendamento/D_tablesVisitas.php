<?php
include("../../verificacaoDeLogin.php");
include("../../config.php/base.php");
// --- LOGICA DE TEMPO REAL MANTENDO SEU DESIGN ---
date_default_timezone_set('Europe/Lisbon');

function obterStatusReal($data_inicio_str, $tipologia, $comentario)
{
    $inicio = strtotime($data_inicio_str);
    $minutos = 0;
    switch (strtoupper($tipologia)) {
        case 'T0':
        case 'T1':
            $minutos = 30;
            break;
        case 'T2':
        case 'T3':
            $minutos = 60;
            break;
        case 'T4':
            $minutos = 90;
            break;
        default:
            $minutos = 120;
    }
    $fim = $inicio + (($minutos + 30) * 60);
    $agora = time();

    if ($agora < $inicio)
        return "Em breve";
    if ($agora >= $inicio && $agora <= $fim)
        return "Em curso";
    return (empty($comentario)) ? "Finalizada, mas sem comentário" : "Finalizada";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Admin - HomeSpace</title>
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <?php include("../../E_sidebar.php")?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                
                <?php include("../../E_topbar.php")?>

                <div class="container-fluid">
                    <nav aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb bg-white shadow-sm border-left-primary d-flex align-items-center mb-5">
                            <li class="breadcrumb-item text-muted">Registros de visitas</li>
                            <a href="../../form/agendamentos/D_addVisitas.php" class="btn btn-sm btn-primary shadow-sm ml-auto">
                                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Adicionar visita
                            </a>
                        </ol>
                    </nav>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registros</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nome do visitante</th>
                                            <th>Imóvel</th>
                                            <th>Agente</th>
                                            <th>Data de visita</th>
                                            <th>Comentário</th>
                                            <th>Status</th>
                                            <th>Resultado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Adicionei i.tipologia na sua Query para o calculo funcionar
                                        $sql = "SELECT uhi.id_registro, u.Nome, i.Morada, i.tipologia, a.nome as nome_agente, uhi.data, uhi.comentarios , uhi.resultado
                                                FROM utilizador u, agentes a, imoveis i, utilizador_has_imoveis uhi 
                                                WHERE u.ID_Utilizador = uhi.Utilizador_ID_Utilizador 
                                                AND i.ID_Imoveis=uhi.Imoveis_ID_Imoveis 
                                                AND a.ID_Agentes=uhi.Agentes_ID_Agentes
                                                ORDER BY uhi.id_registro DESC";

                                        $result = mysqli_query($conn, $sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                // Variáveis originais do seu código
                                                $idDeVisitas = $row['id_registro'];
                                                $nomeDoVisitante = $row['Nome'];
                                                $MoradaDoImovel = $row['Morada'];
                                                $nomeDoAgente = $row['nome_agente'];
                                                $dataDeVisita = $row['data'];
                                                $Comentario = $row['comentarios'];
                                                $resultado = $row["resultado"];

                                                // NOVO: Cálculo do status em tempo real
                                                $Curso_da_visita = obterStatusReal($dataDeVisita, $row['tipologia'], $Comentario);

                                                // Lógica para esconder os botões
                                                $display_style = ($Curso_da_visita == "Finalizada") ? "display:none !important;" : "";
                                                ?>

                                                <tr>
                                                    <td> <?= $idDeVisitas ?> </td>
                                                    <td> <?= $nomeDoVisitante ?> </td>
                                                    <td> <?= $MoradaDoImovel ?></td>
                                                    <td> <?= $nomeDoAgente ?></td>
                                                    <td> <?= $dataDeVisita ?></td>
                                                    <td> <?= $Comentario ?></td>
                                                    <th> <?= $Curso_da_visita ?></th>
                                                    <th> <?= $resultado ?></th>

                                                    <td class="d-flex align-items-center">
                                                        <?php if ($Curso_da_visita == "Finalizada"): ?>
                                                            <i class="fas fa-check-circle text-success fa-lg" title="Concluído"></i>
                                                        <?php endif; ?>

                                                        <form action='../../form/agendamentos/D_Alterar_registro.php' method='post'
                                                            style="<?= $display_style ?>">
                                                            <input type='hidden' name='id' value='<?= $idDeVisitas ?>'>
                                                            <button type='submit'
                                                                class='btn btn-primary btn-sm mr-3'>Alterar</button>
                                                        </form>

                                                        <button type='button' class='btn btn-danger btn-circle btn-sm mr-3'
                                                            style="<?= $display_style ?>" data-toggle='modal'
                                                            data-target='#modalExcluirimovel<?= $idDeVisitas ?>'>
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <div class='modal fade' id='modalExcluirimovel<?= $idDeVisitas ?>' tabindex='-1'
                                                    role='dialog'>
                                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title text-danger'>Eliminar o registro de
                                                                    visita</h5>
                                                                <button type='button' class='close'
                                                                    data-dismiss='modal'><span>&times;</span></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <strong>Atenção:</strong> esta ação é definitiva. <br>
                                                                Deseja realmente remover este registro de visita?
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary'
                                                                    data-dismiss='modal'>Não</button>
                                                                <form action='../../processo/agendamento/D_Visitas_excluir_consul.php' method='post'
                                                                    class='d-inline'>
                                                                    <input type='hidden' name='id'
                                                                        value='<?= $idDeVisitas ?>'>
                                                                    <button type='submit' class='btn btn-danger'>Sim,
                                                                        remover</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>Nenhum registo encontrado</td></tr>";
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../endor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../js/sb-admin-2.min.js"></script>
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../js/demo/datatables-demo.js"></script>
</body>

</html>