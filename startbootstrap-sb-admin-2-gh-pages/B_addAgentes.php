<?php
include("verificacaoDeLogin.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Imóvel</title>

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
                <div class="container-fluid">

                    <nav aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb bg-white shadow-sm border-left-primary d-flex align-items-center mb-5">

                            <li class="breadcrumb-item text-muted">Agentes</li>
                            <li class="breadcrumb-item active font-weight-bold" aria-current="page"> Adicionar agente
                            </li>

                           
                        </ol>
                    </nav>
                </div>
                <!-- /.container-fluid -->

                <!-- Formulário centralizado -->
                <div class="d-flex justify-content-center mt-4">
                    <div class="col-md-8 col-lg-6">

                        <form class="row g-3" action="B_addAgentes_consul.php" method="post" id="ADDagentes"
                            enctype="multipart/form-data">

                            <!-- Nome -->
                            <div class="col-12 mt-3">
                                <label for="inputNome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="inputNome" name="nome" autocomplete="off"
                                    required>
                            </div>

                            <!-- Número de Telemóvel -->
                            <div class="col-6 mt-3">
                                <label for="inputNumero" class="form-label">Número de Telemóvel</label>
                                <input type="text" class="form-control" id="inputNumero" name="numero"
                                    autocomplete="off" maxlength="9" placeholder="XXX-XXX-XXX" required>
                            </div>

                            <!-- Email -->
                            <div class="col-6 mt-3">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email" autocomplete="off"
                                    required>
                            </div>


                            <!-- Serviços -->
                            <div class="col-6 mt-3">
                                <label for="inputServicos" class="form-label">Serviços</label>
                                <select class="form-control" id="inputServicos" name="servicos" required>
                                    <option value="">Selecione um serviço</option>
                                    <?php
                                    $lista = ["Arrendamento", "Vendas"];
                                    foreach ($lista as $value) {
                                        ?>
                                        <option><?php echo $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Sexo -->
                            <div class="col-6 mt-3">
                                <label for="inputSexo" class="form-label">Sexo</label>
                                <select class="form-control" id="inputSexo" name="sexo" required>
                                    <option value="">Selecione o seu sexo</option>
                                    <option value="0">Masculino</option>
                                    <option value="1">Feminino</option>
                                </select>
                            </div>

                            
                            <!-- Imagens -->
                            <div class=" col-12 mt-3 ">
                                <label for="inputImagens" class="form-label">Imagens (URL)</label>
                                <input type="file" class="form-control" id="inputImagem" name="inputImagem" accept="image/jpeg, image/jpg, image/png, image/webp" required>

                                <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i> Selecione uma imagem
                                        (JPG, PNG ou WEBP).
                                </small>
                                <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i> Limite de arquivo de 500KB
                                </small>
                            </div>

                            <!-- Botão -->
                            <div class="col-12 text-center mt-4 mb-5">
                                <button type="button" class="btn btn-primary px-5" id="btnAdicionar">Adicionar
                                    Agente</button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>

            <!--End of Formulário-->

        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Modal de confirmação -->
        <div class="modal fade" id="confirmarModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Confirmação de envio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Deseja realmente enviar os dados do imóvel?
                    </div>

                    <!-- IMPORTANTE -->
                    <!-- o botão está ligando com o form e em submit -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-success" form="ADDagentes">
                            Sim
                        </button>
                    </div>

                </div>
            </div>
        </div>


        <!-- script importante para verifica se as validação estão sendo feitas  -->
        <script>
            document.getElementById('btnAdicionar').addEventListener('click', function () {
                var form = document.getElementById('ADDagentes');

                if (form.checkValidity()) {
                    // Só abre o modal se tudo estiver correto
                    $('#confirmarModal').modal('show');
                } else {
                    // Mostra os erros
                    form.reportValidity();
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