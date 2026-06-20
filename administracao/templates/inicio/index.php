<?php
include("../../verificacaoDeLogin.php");
include("../../config.php/base.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin - HomeSpace</title>

    <!-- Fonts -->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- CSS -->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include("../../E_sidebar.php") ?> 

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php include("../../E_topbar.php") ?>


                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Painel</h1>
                    </div>

                    <!-- LINHA SUPERIOR -->
                    <div class="row">

                        <!-- PIZZA -->
                        <div class="col-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Imóveis / ação</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2"><i class="fas fa-circle text-primary"></i> Vendas</span>
                                        <span class="mr-2"><i class="fas fa-circle text-success"></i> Alugamento</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CARDS -->
                        <div class="col-6 d-flex flex-column">

                            <!-- Visitas -->
                            <div class="mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Visitas marcadas
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            $sql4 = "SELECT Count(id_registro) as total FROM utilizador_has_imoveis;";
                                            $result = mysqli_query($conn, $sql4);
                                            $row = mysqli_fetch_assoc($result);
                                            echo $row['total'];
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Imóveis -->
                            <div class="mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Imóveis ativos
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            $sql1 = "SELECT Count(ID_Imoveis) as total FROM imoveis WHERE disponibilidade=1;";
                                            $result = mysqli_query($conn, $sql1);
                                            $row = mysqli_fetch_assoc($result);
                                            echo $row['total'];
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Agentes -->
                            <div class="mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Agentes disponíveis
                                        </div>
                                        <?php
                                        $sql2 = "SELECT Count(ID_Agentes) as total FROM agentes WHERE disponibilidades=1;";
                                        $result = mysqli_query($conn, $sql2);
                                        $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <div class="h5 mb-2 font-weight-bold text-gray-800"><?= $row['total'] ?></div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-info"
                                                style="width: <?= ($row['total'] / 40) * 100 ?>%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Usuários -->
                            <div class="mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Usuários
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            $sql3 = "SELECT Count(ID_Utilizador) as total FROM utilizador;";
                                            $result = mysqli_query($conn, $sql3);
                                            $row = mysqli_fetch_assoc($result);
                                            echo $row['total'];
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TABELA -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-5">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Registros de visitas (Hoje)</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Visitante</th>
                                                    <th>Imóvel</th>
                                                    <th>Agente</th>
                                                    <th>Data/Hora</th>
                                                    <th>Comentário</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Lógica de tempo real
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
                                                    return (empty($comentario)) ? "Finalizada (sem comentário)" : "Finalizada";
                                                }

                                                // Query filtrando APENAS HOJE e incluindo tipologia para o cálculo
                                                $sql = "SELECT uhi.id_registro, u.Nome, i.Morada, i.tipologia, a.nome as nome_agente, uhi.data, uhi.comentarios
                                    FROM utilizador u, agentes a, imoveis i, utilizador_has_imoveis uhi
                                    WHERE u.ID_Utilizador=uhi.Utilizador_ID_Utilizador
                                    AND i.ID_Imoveis=uhi.Imoveis_ID_Imoveis
                                    AND a.ID_Agentes=uhi.Agentes_ID_Agentes
                                    AND DATE(uhi.data) = CURDATE()
                                    ORDER BY uhi.data ASC;";

                                                $result = mysqli_query($conn, $sql);

                                                while ($row = $result->fetch_assoc()) {
                                                    $status = obterStatusReal($row['data'], $row['tipologia'], $row['comentarios']);
                                                    ?>
                                                    <tr>
                                                        <td><?= $row['id_registro'] ?></td>
                                                        <td><?= $row['Nome'] ?></td>
                                                        <td><?= $row['Morada'] ?></td>
                                                        <td><?= $row['nome_agente'] ?></td>
                                                        <td><?= date('d/m/Y H:i', strtotime($row['data'])) ?></td>
                                                        <td><?= $row['comentarios'] ?></td>
                                                        <td class="font-weight-bold"><?= $status ?></td>
                                                        <td class="text-center">
                                                            <?php if ($status == "Finalizada"): ?>
                                                                <i class="fas fa-check-circle text-success fa-lg"></i>
                                                            <?php else: ?>
                                                                <i class="fas fa-clock text-gray-400"></i>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../js/sb-admin-2.min.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../js/demo/datatables-demo.js"></script>

</body>

</html>