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

$id = $_POST['id'];

$sql = "SELECT u.Nome , a.nome , i.Morada, uhi.data as 'data', uhi.Status_de_visita , uhi.comentarios
        FROM utilizador_has_imoveis uhi , utilizador u , agentes a, imoveis i
        WHERE uhi.Utilizador_ID_Utilizador  = u.ID_Utilizador AND uhi.Imoveis_ID_Imoveis = i.ID_Imoveis AND uhi.Agentes_ID_Agentes = a.ID_Agentes and uhi.id_registro  like  $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {

        $Utilizador_ID_Utilizador = $row["Nome"];
        $Agentes_ID_Agentes = $row["nome"];
        $Imoveis_ID_Imoveis = $row["Morada"];
        // --- AQUI ESTÁ A SOLUÇÃO ---
        $data_original = $row["data"];
        $data_apenas = date('Y-m-d', strtotime($data_original)); // Extrai 2023-10-25
        $hora_apenas = date('H:i', strtotime($data_original));   // Extrai 14:30
        // ---------------------------
        $Curso_da_visita = $row["Status_de_visita"];


    }
} else {
    echo "0 results";
}




echo "$Utilizador_ID_Utilizador";
echo "$Imoveis_ID_Imoveis";
echo "$Agentes_ID_Agentes";

echo "$Curso_da_visita "

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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                            <li class="breadcrumb-item text-muted">Utilizador</li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Alterar registro</li>
                        </ol>
                    </nav>
                </div>


                <!-- /.container-fluid -->

                <!-- Formulário centralizado -->
                <div class="d-flex justify-content-center mt-4">
                    <div class="col-md-8 col-lg-6">

                        <form class="row g-3" action="D_Alterar_registro_consul.php" method="post">

                            <!-- ID de registro -->
                            <input type="hidden" name="id" value="<?= $id ?>">

                            <!-- Nome do visitante -->
                            <div class="col-6">
                                <label for="inputNomeVisitante" class="form-label">Nome do visitante</label>
                                <select id="inputNomeVisitante" name="nomeDoVisitante" class="form-control" required>
                                    <option value=""></option>

                                    <!-- lembramos que recebemos os name via post  -->
                                    <?php


                                    $sql = "SELECT ID_Utilizador, Nome FROM utilizador";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $selected = ($row["Nome"] == $Utilizador_ID_Utilizador) ? "selected" : "";
                                            echo '<option value="' . $row["ID_Utilizador"] . '" ' . $selected . '>' . $row["Nome"] . '</option>';
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>


                            <!-- Nome do Agente -->
                            <div class="col-6">
                                <label for="inputAgentes" class="form-label">Nome do agente</label>
                                <select class="form-control" id="inputAgentes" name="NomeDoAgente" required>
                                    <option value=""></option>

                                    <!-- lembramos que recebemos os name via post  -->
                                    <?php


                                    $sql = "SELECT ID_Agentes, nome FROM Agentes";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $selected = ($row["nome"] == $Agentes_ID_Agentes) ? "selected" : "";
                                            echo '<option value="' . $row["ID_Agentes"] . '" ' . $selected . '>' . $row["nome"] . '</option>';
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>


                            <!-- Nome do imóvel -->
                            <div class="col-12 mt-3 ">
                                <label for="inputImovel" class="form-label">Nome do imóvel</label>
                                <select class="form-control" id="inputImovel" name="NomeDoImovel" required>

                                    <option value=""></option>

                                    <!-- lembramos que recebemos os name via post  -->
                                    <?php


                                    $sql = "SELECT ID_Imoveis, Morada FROM imoveis";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            $selected = ($row["Morada"] == $Imoveis_ID_Imoveis) ? "selected" : "";
                                            echo '<option value="' . $row["ID_Imoveis"] . '" ' . $selected . '>' . $row["Morada"] . '</option>';
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>


                            <!-- data de registro -->
                            <div class="col-6 MT-3">
                                <label for="inputData" class="form-label">Data</label>
                                <input type="date" class="form-control" id="inputData" name="dataDeRegistro"
                                    value="<?= $data_apenas ?>" required>
                            </div>

                            <!-- Hora atual -->
                            <div class="col-6 mt-3">
                                <label for="inputHora" class="form-label">Hora inícial</label>
                                <select name="horaDeRegistro" id="inputHora" class="form-control">
                                    <?php
                                    $inicio_dia = strtotime('08:00');
                                    $fim_dia = strtotime('18:30');

                                    $inicio_almoco = strtotime('13:00');
                                    $fim_almoco = strtotime('14:30');

                                    for ($i = $inicio_dia; $i <= $fim_dia; $i += 600) {
                                        $tempo = date('H:i', $i);
                                        $esta_no_almoco = ($i >= $inicio_almoco && $i < $fim_almoco);
                                        $status = $esta_no_almoco ? "disabled style='color: #ccc;'" : "";

                                        // VERIFICA SE ESTA É A HORA QUE ESTÁ NO BANCO
                                        $selected_hora = ($tempo == $hora_apenas) ? "selected" : "";

                                        $label = $esta_no_almoco ? "$tempo (Almoço)" : $tempo;
                                        echo "<option value='$tempo' $status $selected_hora>$label</option>";
                                    }
                                    ?>

                                </select>
                            </div>

                            <!-- Status de visita -->
                          

                            <div class="col-12 mt-3">
                                <label for="comentarios" class="form-label">Comentários sobre a visita</label>
                                <input type="text" class="form-control" id="comentarios" name="comentarios">
                            </div>

                            <!-- Botão -->
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary px-5">Alterar Visita</button>
                            </div>

                        </form>
                    </div>





                    <!--End of Formulário-->

                </div>
                <!-- End of Main Content -->


            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <!-- Para o AJAX , seleciona o imóvel de acordo com a escolha do agente  -->
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

                                // Definição dos limites em minutos
                                var minAlmoco = 13 * 60;        // 13:00 = 780 minutos
                                var minFimDia = 18 * 60 + 30;   // 18:30 = 1110 minutos

                                $('#inputHora option').each(function () {
                                    var option = $(this);
                                    var horaTexto = option.val();
                                    if (!horaTexto) return;

                                    var minNovoInicio = timeToMinutes(horaTexto);
                                    var minNovoFim = minNovoInicio + duracaoNova;

                                    var colidiu = false;

                                    // 1. REFINAMENTO: Bloqueio por limites de horário (Almoço e Fim do Dia)
                                    // Se começa antes das 13h mas termina depois das 13h...
                                    if (minNovoInicio < minAlmoco && minNovoFim > minAlmoco) {
                                        colidiu = true;
                                    }
                                    // Se o fim da visita passa das 18:30...
                                    if (minNovoFim > minFimDia) {
                                        colidiu = true;
                                    }

                                    // 2. Verificação de colisões com outras visitas (se ainda não colidiu nos limites)
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

                                    // Aplica o bloqueio visual e funcional
                                    if (colidiu) {
                                        option.hide().prop('disabled', true);
                                        if (valorSelecionadoNoMomento === horaTexto) {
                                            $('#inputHora').val('');
                                        }
                                    }
                                });
                            }
                        });
                    }
                }

                function resetarHorarios() {
                    $('#inputHora option').each(function () {
                        var txt = $(this).text();
                        if (txt.indexOf("Almoço") === -1) {
                            $(this).show().prop('disabled', false).text($(this).val());
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