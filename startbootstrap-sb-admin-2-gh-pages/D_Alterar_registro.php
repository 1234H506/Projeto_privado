<?php
include("verificacaoDeLogin.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Europe/Lisbon');

$id = $_POST['id'] ?? null;

if (!$id) {
    die("ID de registro inválido");
}

// USAR PREPARED STATEMENT para segurança
$stmt = $conn->prepare("SELECT u.Nome, a.nome, i.Morada, i.Tipologia, uhi.data, uhi.Status_de_visita, uhi.resultado, uhi.comentarios
                        FROM utilizador_has_imoveis uhi
                        INNER JOIN utilizador u ON uhi.Utilizador_ID_Utilizador = u.ID_Utilizador
                        INNER JOIN agentes a ON uhi.Agentes_ID_Agentes = a.ID_Agentes
                        INNER JOIN imoveis i ON uhi.Imoveis_ID_Imoveis = i.ID_Imoveis
                        WHERE uhi.id_registro = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Registro não encontrado");
}

$row = $result->fetch_assoc();
$Utilizador_ID_Utilizador = $row["Nome"];
$Agentes_ID_Agentes = $row["nome"];
$Imoveis_ID_Imoveis = $row["Morada"];
$Tipologia = $row["Tipologia"];
$data_original = $row["data"];
$data_apenas = date('Y-m-d', strtotime($data_original));
$hora_apenas = date('H:i', strtotime($data_original));
$Curso_da_visita = $row["Status_de_visita"];
$resultado_atual = $row["resultado"];
$comentarios_atual = $row["comentarios"];

$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Visita</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include("E_sidebar.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include("E_topbar.php"); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid pb-3 ">
                    <nav aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb bg-white shadow-sm border-left-primary">
                            <li class="breadcrumb-item text-muted">Visitas</li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Alterar registro</li>
                        </ol>
                    </nav>
                </div>

                <!-- Formulário centralizado -->
                <div class="d-flex justify-content-center mt-4">
                    <div class="col-md-8 col-lg-6">

                        <form class="row g-3" action="D_Alterar_registro_consul.php" method="post">

                            <!-- ID de registro (hidden) -->
                            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

                            <!-- Nome do visitante -->
                            <div class="col-6">
                                <label for="inputNomeVisitante" class="form-label">Nome do visitante</label>
                                <select id="inputNomeVisitante" name="nomeDoVisitante" class="form-control" required>
                                    <option value=""></option>
                                    <?php
                                    $sql = "SELECT ID_Utilizador, Nome FROM utilizador";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $selected = ($row["Nome"] == $Utilizador_ID_Utilizador) ? "selected" : "";
                                            echo '<option value="' . htmlspecialchars($row["ID_Utilizador"]) . '" ' . $selected . '>' . htmlspecialchars($row["Nome"]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Nome do Agente -->
                            <div class="col-6">
                                <label for="inputAgentes" class="form-label">Nome do agente</label>
                                <select class="form-control" id="inputAgentes" name="NomeDoAgente" required>
                                    <option value=""></option>
                                    <?php
                                    $sql = "SELECT ID_Agentes, nome FROM Agentes";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $selected = ($row["nome"] == $Agentes_ID_Agentes) ? "selected" : "";
                                            echo '<option value="' . htmlspecialchars($row["ID_Agentes"]) . '" ' . $selected . '>' . htmlspecialchars($row["nome"]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Nome do imóvel -->
                            <div class="col-12 mt-3">
                                <label for="inputImovel" class="form-label">Nome do imóvel</label>
                                <select class="form-control" id="inputImovel" name="NomeDoImovel" required>
                                    <option value=""></option>
                                    <?php
                                    $sql = "SELECT ID_Imoveis, Morada FROM imoveis";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $selected = ($row["Morada"] == $Imoveis_ID_Imoveis) ? "selected" : "";
                                            echo '<option value="' . htmlspecialchars($row["ID_Imoveis"]) . '" ' . $selected . '>' . htmlspecialchars($row["Morada"]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Data de registro -->
                            <div class="col-6 mt-3">
                                <label for="inputData" class="form-label">Data</label>
                                <input type="date" class="form-control" id="inputData" name="dataDeRegistro" value="<?= htmlspecialchars($data_apenas) ?>" required>
                            </div>

                            <!-- Hora -->
                            <div class="col-6 mt-3">
                                <label for="inputHora" class="form-label">Hora inícial</label>
                                <select name="horaDeRegistro" id="inputHora" class="form-control" required>
                                    <?php
                                    $inicio_dia = strtotime('08:00');
                                    $fim_dia = strtotime('18:30');
                                    $inicio_almoco = strtotime('13:00');
                                    $fim_almoco = strtotime('14:30');

                                    for ($i = $inicio_dia; $i <= $fim_dia; $i += 600) {
                                        $tempo = date('H:i', $i);
                                        $esta_no_almoco = ($i >= $inicio_almoco && $i < $fim_almoco);
                                        $status = $esta_no_almoco ? "disabled style='color: #ccc;'" : "";
                                        $selected_hora = ($tempo == $hora_apenas) ? "selected" : "";
                                        $label = $esta_no_almoco ? "$tempo (Almoço)" : $tempo;
                                        echo "<option value='$tempo' $status $selected_hora>$label</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Status de visita (READ-ONLY) -->
                            <div class="col-6 mt-3">
                                <label for="input_status" class="form-label">Status da Visita</label>
                                <input type="text" class="form-control" id="input_status" name="input_status" value="<?= htmlspecialchars($Curso_da_visita) ?>" readonly>
                                <small class="text-muted">Atualizado automaticamente baseado na data/hora</small>
                            </div>

                            <!-- Resultado da visita -->
                            <div class="col-6 mt-3">
                                <label for="input_resultado" class="form-label">Resultado da Visita</label>
                                <select name="input_resultado" id="input_resultado" class="form-control" required>
                                    <option value="">Selecione...</option>
                                    <option value="pendente" <?= ($resultado_atual == 'pendente') ? 'selected' : '' ?>>Pendente</option>
                                    <option value="vendido" <?= ($resultado_atual == 'vendido') ? 'selected' : '' ?>>Vendido</option>
                                    <option value="nao_vendido" <?= ($resultado_atual == 'nao_vendido') ? 'selected' : '' ?>>Não Vendido</option>
                                </select>
                            </div>

                            <!-- Comentários de visita -->
                            <div class="col-12 mt-3">
                                <label for="comentarios" class="form-label">Comentários sobre a visita</label>
                                <textarea class="form-control" id="comentarios" name="comentarios" rows="4"><?= htmlspecialchars($comentarios_atual) ?></textarea>
                            </div>

                            <!-- Botão -->
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary px-5">Alterar Visita</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Scripts AJAX -->
    <script>
        $(document).ready(function () {
            // 1. QUANDO MUDAR O AGENTE
            $('#inputAgentes').change(function () {
                var id_agente = $(this).val();
                $('#inputImovel').html('<option value="">Carregando imóveis...</option>');
                $('#inputData').val('');
                resetarHorarios();

                if (id_agente != "") {
                    $.ajax({
                        url: "D_ajax_getImoveis.php",
                        type: "POST",
                        data: { id_agente: id_agente },
                        success: function (data) {
                            $('#inputImovel').html(data);
                        },
                        error: function() {
                            $('#inputImovel').html('<option value="">Erro ao carregar imóveis</option>');
                        }
                    });
                } else {
                    $('#inputImovel').html('<option value="">Selecione o agente...</option>');
                }
            });

            // 2. QUANDO MUDAR IMÓVEL OU DATA
            $('#inputImovel, #inputData').change(function () {
                verificarDisponibilidade();
            });

            function verificarDisponibilidade() {
                var id_agente = $('#inputAgentes').val();
                var id_imovel = $('#inputImovel').val();
                var data_visita = $('#inputData').val();

                if (id_agente && id_imovel && data_visita) {
                    $('#inputHora').prop('disabled', true);

                    $.ajax({
                        url: "D_ajax_verificarDisponibilidade.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id_agente: id_agente,
                            id_imovel: id_imovel,
                            data_visita: data_visita
                        },
                        success: function (response) {
                            $('#inputHora').prop('disabled', false);
                            resetarHorarios();

                            var duracaoNova = parseInt(response.nova_duracao);
                            var ocupados = response.ocupados;
                            var valorSelecionadoNoMomento = $('#inputHora').val();

                            var minAlmoco = 13 * 60;
                            var minFimDia = 18 * 60 + 30;

                            $('#inputHora option').each(function () {
                                var option = $(this);
                                var horaTexto = option.val();
                                if (!horaTexto) return;

                                var minNovoInicio = timeToMinutes(horaTexto);
                                var minNovoFim = minNovoInicio + duracaoNova;

                                var colidiu = false;

                                if (minNovoInicio < minAlmoco && minNovoFim > minAlmoco) {
                                    colidiu = true;
                                }
                                if (minNovoFim > minFimDia) {
                                    colidiu = true;
                                }

                                if (!colidiu) {
                                    for (var i = 0; i < ocupados.length; i++) {
                                        var horaBanco = ocupados[i].inicio.split(' ')[1].substring(0, 5);
                                        var minOcupInicio = timeToMinutes(horaBanco);
                                        var minOcupFim = minOcupInicio + parseInt(ocupados[i].duracao);

                                        if (minNovoInicio < minOcupFim && minNovoFim > minOcupInicio) {
                                            colidiu = true;
                                            break;
                                        }
                                    }
                                }

                                if (colidiu) {
                                    option.hide().prop('disabled', true);
                                    if (valorSelecionadoNoMomento === horaTexto) {
                                        $('#inputHora').val('');
                                    }
                                } else {
                                    option.show().prop('disabled', false);
                                }
                            });
                        },
                        error: function() {
                            alert('Erro ao verificar disponibilidade');
                        }
                    });
                }
            }

            function resetarHorarios() {
                $('#inputHora option').each(function () {
                    var txt = $(this).text();
                    if (txt.indexOf("Almoço") === -1) {
                        $(this).show().prop('disabled', false);
                    }
                });
            }

            function timeToMinutes(t) {
                var p = t.split(':');
                return (parseInt(p[0]) * 60) + parseInt(p[1]);
            }
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>