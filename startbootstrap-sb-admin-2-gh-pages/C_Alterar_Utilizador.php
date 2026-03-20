<?php

include("verificacaoDeLogin.php");

$id_utilizador = $_POST['id'];


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

$sql = "SELECT * FROM `utilizador` WHERE ID_Utilizador= $id_utilizador";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {

        $nome = $row['Nome'];
        $tel = $row['nr_telemovel'];
        $pass = $row['Password'];
        $email = $row['Email'];
        $imagem = $row["Imagem"];
        $sexo = $row["Sexo"];
        $admin = $row["administrador"];



        switch ($sexo) {
            case 0:
                $sexo = "Maculino";
                break;
            case 1:
                $sexo = "Feminino";
                break;
            default:
                "Aconteceu um erro ";
                break;
        }

        switch ($admin) {
            case 0:
                $admin = "Utilizador";
                break;
            case 1:
                $admin = "Admin";
                break;
            default:
                "Aconteceu um erro";
                break;
        }

    }
} else {
    echo "0 results";
}

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Utilizador</title>

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

                <div class="container-fluid ">
                    <nav aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb bg-white shadow-sm border-left-primary">
                            <li class="breadcrumb-item text-muted">Utilizador</li>
                            <li class="breadcrumb-item active font-weight-bold" aria-current="page">Editar registro
                            </li>
                        </ol>
                    </nav>
                </div>


                <!-- /.container-fluid -->

                <!-- Formulário centralizado -->
                <div class="d-flex justify-content-center mt-4">
                    <div class="col-md-8 col-lg-6">


                        <form class="row g-3" action="C_alterar_utilizador_consul.php" method="POST"
                            id="alterarUtilizador" enctype="multipart/form-data">




                            <!--Pegamos id do agente-->
                            <input type="hidden" name="id" value="<?php echo $id_utilizador ?>">

                            <!-- Nome -->
                            <div class="col-12 mt-3">
                                <label for="inputNome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="inputNome" name="nome"
                                    value="<?php echo $nome ?>" autocomplete="off" required>
                            </div>

                            <!-- Email -->
                            <div class="col-12 mt-3">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email"
                                    value="<?php echo $email ?>" autocomplete="off" required>
                            </div>

                            <!-- Número de Telemóvel -->
                            <div class="col-6 mt-3">
                                <label for="inputNumero" class="form-label">Número de Telemóvel</label>
                                <input type="text" class="form-control" id="inputNumero" name="numero"
                                    value="<?php echo $tel ?>" autocomplete="off" required>
                            </div>

                            <!-- Sexo -->
                            <div class="col-6 mt-3">
                                <label for="inputSexo" class="form-label">Sexo</label>
                                <select class="form-control" id="inputSexo" name="sexo" required>
                                    <option value="0" <?php echo ($sexo == "Masculino") ? 'selected' : ''; ?>>Masculino
                                    </option>
                                    <option value="1" <?php echo ($sexo == "Feminino") ? 'selected' : ''; ?>>Feminino
                                    </option>
                                </select>
                            </div>


                            <!-- Imagem de utilizador -->
                            <div class="col-6 mt-3">
                                <label for="inputImagem" class="form-label">Imagem de perfil</label>
                                <input type="file" class="form-control" id="inputImagem" name="inputImagem" accept="image/jpeg, image/jpg, image/png, image/webp" >

                                <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i> Selecione uma imagem
                                        (JPG, PNG ou WEBP).
                                </small>
                                <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i> Limite de arquivo de 500KB
                                </small>


                            </div>



                            <!-- ADMIN -->
                            <div class="col-6 mt-3">
                                <label for="inputAdmin" class="form-label">Admin</label>
                                <select class="form-control" id="inputAdmin" name="Admin" required>
                                    <option value="0" <?php echo ($admin == "Utilizador") ? 'selected' : ''; ?>>Utilizador
                                    </option>
                                    <option value="1" <?php echo ($admin == "Admin") ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>



                            <!-- Botão -->
                            <div class="col-12 text-center mt-4">
                                <button type="button" class="btn btn-primary px-5" id="btnAlterar">Alterar
                                    registro</button>
                            </div>

                        </form>
                    </div>


                </div>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="confirmarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirmação de alterações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Deseja realmente realizar as alterações?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-success" form="alterarUtilizador">
                        Sim
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- script importante para verifica se as validação estão sendo feitas  -->
    <script>
        document.getElementById('btnAlterar').addEventListener('click', function () {
            var form = document.getElementById('alterarUtilizador');

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