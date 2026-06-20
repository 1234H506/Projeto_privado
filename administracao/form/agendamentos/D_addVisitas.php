<?php
include("../../verificacaoDeLogin.php");

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
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../templates/inicio/index.php">
                <div class="sidebar-brand-text mx-3">HomeSpace Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../../templates/inicio/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Heading -->
            <div class="sidebar-heading">
                Dados
            </div>



            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../../templates/agendamento/D_tablesVisitas.php">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    <span>Registros de visitas</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu imoveis -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-building fa-2x text-gray-300"></i>
                    <span>Imóveis</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../../templates/imoveis/A_tablesCasas.php">Imóveis - Disponível</a>
                        <a class="collapse-item" href="../../templates/imoveis/A_tablesCasasArquivadas.php">Imóveis - Arquivados</a>
                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-address-card fa-2x text-gray-300"></i>
                    <span>Agentes</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../../templates/agentes/B_tablesAgentes.php">Agentes - Disponível</a>
                        <a class="collapse-item" href="../../templates/agentes/B_tablesAgentesArquivados.php">Agentes - Arquivados</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link"
                    href="../../templates/utilizador/C_tablesUtilizador.php">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                    <span>Utilizador</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
               
                <?php include("../../E_topbar.php")?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="container-fluid pb-3 ">
                        <nav aria-label="breadcrumb" class="mt-4">
                            <ol class="breadcrumb bg-white shadow-sm border-left-primary">
                                <li class="breadcrumb-item text-muted">Utilizador</li>
                                <li class="breadcrumb-item text-muted" aria-current="page">Adicionar visita</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Formulário centralizado -->
                <div class="d-flex justify-content-center mt-4">
                    <div class="col-md-8 col-lg-6">

                        <form class="row g-3" action="../../processo/agendamento/D_addVisitas_consul.php" method="post" id="addVisita">


                            <!-- ID de registro -->
                            <input type="hidden" name="id">

                            <!-- Nome do visitante -->
                            <div class="col-6 mt-3">
                                <label for="inputNomeVisitante" class="form-label">Nome do visitante</label>
                                <select id="inputNomeVisitante" name="nomeDoVisitante" class="form-control" required>
                                    <option value="">Selecione...</option>

                                    <!-- lembramos que recebemos os name via post  -->
                                    <?php

                                    $sql = "SELECT ID_Utilizador, Nome FROM utilizador WHERE administrador = 0";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["ID_Utilizador"] . '">' . $row["Nome"] . '</option>';
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>


                            <!-- Nome do Agente -->
                            <div class="col-6 mt-3">
                                <label for="inputAgentes" class="form-label">Nome do agente</label>
                                <select class="form-control" id="inputAgentes" name="NomeDoAgente" required>
                                    <option value="">Selecione...</option>

                                    <!-- lembramos que recebemos os name via post  -->
                                    <?php


                                    $sql = "SELECT ID_Agentes, nome FROM Agentes WHERE disponibilidades = 1  ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["ID_Agentes"] . '">' . $row["nome"] . '</option>';
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>


                            <!-- Nome do imóvel -->
                            <div class="col-12 mt-3">
                                <label for="inputImovel" class="form-label">Nome do imóvel</label>
                                <select class="form-control" id="inputImovel" name="NomeDoImovel" required>

                                    <option value="">Selecione...</option>


                                </select>
                            </div>


                            <!-- data de registro -->
                            <div class="col-6 mt-3">
                                <label for="inputData" class="form-label">Data de visita</label>
                                <input type="date" class="form-control" id="inputData" name="dataDeRegistro" required>
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

                                        // Lógica da Dica de Ouro:
                                        // Se estiver entre 13:01 e 14:29, adiciona o atributo 'disabled'
                                        $esta_no_almoco = ($i >= $inicio_almoco && $i < $fim_almoco);
                                        $status = $esta_no_almoco ? "disabled style='color: #ccc;'" : "";
                                        $label = $esta_no_almoco ? "$tempo (Almoço)" : $tempo;
                                        ?>

                                        <option value="<?= $tempo; ?>" <?= $status; ?>> <?= $label; ?> </option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>


                            

                            <input type="hidden" name="comentarios">

                            <!-- Botão -->
                            <div class="col-12 text-center mt-4">
                                <button type="button" class="btn btn-primary px-5" id="btnAdicionar">Adicionar
                                    Visita</button>
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



        <!-- Modal de confirmacao  -->
        <div class="modal fade" id="confirmarModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Confirmação de registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Deseja realmente fazer esse registro de visita?
                    </div>

                    <!-- IMPORTANTE -->
                    <!-- o botão está ligando com o form e em submit -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-success" form="addVisita">
                            Sim
                        </button>
                    </div>

                </div>
            </div>
        </div>


        <!-- script importante para verifica se as validação estão sendo feitas  -->
        <script>
            document.getElementById('btnAdicionar').addEventListener('click', function () {
                var form = document.getElementById('addVisita');

                if (form.checkValidity()) {
                    // Só abre o modal se tudo estiver correto
                    $('#confirmarModal').modal('show');
                } else {
                    // Mostra os erros
                    form.reportValidity();
                }
            });
        </script>



        <!-- Fim do modal de confirmação -->


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>




        <!-- Bootstrap core JavaScript-->
        <script src="../../vendor/jquery/jquery.min.js"></script>
        <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>


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
                            url: "../../processo/agendamento/D_ajax_getImoveis.php",
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
                            url: "../../processo/agendamento/D_ajax_verificarDisponibilidade.php",
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
        <!-- Custom scripts for all pages-->
        <script src="../../js/sb-admin-2.min.js"></script>

        <!-- Scripts para marcação de datas -->
        <script src="../../js/confirmacao.js"></script>

</body>

</html>