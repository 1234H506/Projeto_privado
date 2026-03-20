<?php

include("verificacaoDeLogin.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT Morada FROM imoveis WHERE ID_Imoveis = $id_imovel";
$result = $conn->query($sql);
$dados = $result->fetch_assoc();
$morada_selecionada = $dados['Morada'];

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

    <link href="css/sb-admin-2.css" rel="stylesheet">

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




                <div class="container-fluid mb-5">



                    <nav aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb bg-white shadow-sm border-left-primary">
                            <li class="mr-5">
                                <a href="A_galeria_imagem.php" class="btn btn-primary btn-circle ">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                               
                            </li>
                            <li class="breadcrumb-item text-muted">Galeria</li>
                            <li class="breadcrumb-item active font-weight-bold" aria-current="page">Adicionar Imagens
                            </li>
                        </ol>
                    </nav>



                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-10">

                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body bg-light rounded text-center">
                                    <div
                                        class="icon-circle bg-primary text-white p-3 rounded-circle d-inline-flex mb-2">
                                        <i class="fas fa-home fa-lg"></i>
                                    </div>
                                    <h5 class="font-weight-bold text-dark mb-1">
                                        <?= $morada_selecionada; ?> 
                                    </h5>
                                    <span class="text-primary small font-weight-bold">Código do Registro:
                                        #<?php echo $_SESSION['id_imovel'] ?? '---'; ?></span>
                                </div>
                            </div>

                            <div class="card shadow border-bottom-primary">
                                <div class="card-header py-3 bg-white">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Upload de Múltiplas
                                        Imagens</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Formulário para adicionar várias file/imagens na galeria  -->
                                    <form action="A_addImagens_consul.php" method="POST" enctype="multipart/form-data">

                                        <input type="hidden" name="id_imovel"
                                            value="<?php echo $_SESSION['id_imovel'] ?? ''; ?>">

                                        <div class="row justify-content-center">
                                            <div class="col-md-10">
                                                <div class="form-group border p-5 rounded text-center bg-gray-100"
                                                    style="border: 2px dashed #4e73df !important;">
                                                    <i class="fas fa-images fa-3x text-primary mb-3"></i>
                                                    <h6 class="text-dark font-weight-bold mb-4">Selecione as fotos da
                                                        galeria</h6>

                                                    <div class="d-flex justify-content-center"
                                                        style="padding-left: 80px;">
                                                        <input type="file" id="Imagens" name="Imagens_galeria[]"
                                                            class="form-control-file w-auto" accept="image/jpeg, image/jpg, image/png, image/webp" multiple required>
                                                    </div>

                                                    <div class="mt-4 pt-3 border-top">
                                                        <small class="text-muted d-block mb-1" style="font-size:20px;">
                                                            <i class="fas fa-check-circle text-success mr-1"></i>
                                                            Formatos: <strong>JPG, PNG, WEBP e JPEG</strong>.
                                                        </small>
                                                         <small class="text-muted d-block mb-1" style="font-size:20px;">
                                                            <i class="fas fa-check-circle text-success mr-1 mt-1"></i>
                                                            Tamanho máximo de arquivo <strong>800KB</strong>.
                                                        </small>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <button type="submit" name="submit" id="btnConfirmacao" data-toggle="modal"
                                                data-target="#confirmarModal"
                                                class="btn btn-primary btn-icon-split shadow-sm btn-lg px-4">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </span>
                                                <span class="text">Finalizar e Salvar Galeria</span>
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
        </div>

        <!--End of Formulário-->

    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- <div class="modal fade" id="confirmarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirmação de dados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1>Imagens que foram selecionada</h1>
                    <div id="previewContainer" class="mt-3" ></div>
                    Deseja realmente enviar essas fotos ?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-success" form="alterarImovel">
                        Sim
                    </button>
                </div>

            </div>
        </div>
    </div>   -->

    <!-- script importante para verifica se as validação estão sendo feitas  -->
    <!-- <script>
        document.getElementById('btnConfirmacao').addEventListener('click', function () {
            var form = document.getElementById('alterarImovel');

            if (form.checkValidity()) {
                // Só abre o modal se tudo estiver correto
                $('#confirmarModal').modal('show');
            } else {
                // Mostra os erros
                form.reportValidity();
            }
        });
    </script>   -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Não permitir colocar datas de registro que passa do dia atual -->
    <script src="js/confirmacao.js"></script>



</body>

</html>