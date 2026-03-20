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

    <title> Admin - HomeSpace</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

                    <div class="container-fluid pb-3 ">
                        <nav aria-label="breadcrumb" class="mt-4">
                            <ol class="breadcrumb bg-white shadow-sm border-left-primary">
                                <li class="breadcrumb-item text-muted">Utilizador</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registro de utilizador</h6>
                        </div>
                        <form action="Utilizador_consul.php" method="POST"></form>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Número de telemóvel</th>
                                            <th>Email</th>
                                            <th>Administrador</th>
                                            <th>Sexo</th>
                                            <th>Imagem</th>
                                            <TH></TH>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
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

                                        $sql = "SELECT * FROM utilizador";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $nome = $row["Nome"];
                                                $tel = $row["nr_telemovel"];
                                                $email = $row["Email"];
                                                $id = $row["ID_Utilizador"];
                                                $admin = $row["administrador"];
                                                $sexo = $row["Sexo"];
                                                $imagem = $row["Imagem"];

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
                                                ?>
                                                <tr>
                                                    <td><?php echo $id; ?> </td>
                                                    <td><?php echo $nome; ?></td>
                                                    <td><?php echo $tel; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $admin; ?></td>
                                                    <td><?php echo $sexo; ?></td>
                                                    <td><?php echo $imagem; ?></td>
                                                    <td class='text-center'>
                                                        <div class='d-flex justify-content-center align-items-center flex-nowrap'
                                                            style='gap: 8px;'>

                                                            <form action='C_Alterar_Utilizador.php' method='post'>
                                                                <input type='hidden' name='id' value='<?php echo $id; ?>'>
                                                                <button type='submit'
                                                                    class='btn btn-primary btn-sm'>Alterar</button>
                                                            </form>

                                                            <button type='button' class='btn btn-danger btn-circle btn-sm mr-3'
                                                                data-toggle='modal'
                                                                data-target='#modalExcluirimovel<?= $id ?>'><i
                                                                    class="fas fa-trash"></i></button>

                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal de excluir -->
                                                <div class='modal fade' id='modalExcluirimovel<?= $id ?>' tabindex='-1'
                                                    role='dialog'>
                                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title text-danger'>Eliminar o usuário(a)</h5>
                                                                <button type='button' class='close'
                                                                    data-dismiss='modal'><span>&times;</span></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <strong>Atenção:</strong> esta ação é definitiva. <br>
                                                                Deseja realmente remover este usuário(a)?
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary'
                                                                    data-dismiss='modal'>Não</button>
                                                                <form action='C_Excluir_Utilizador_consul.php' method='post'
                                                                    class='d-inline'>
                                                                    <input type='hidden' name='id' value='<?php echo $id ?>'>
                                                                    <button type='submit' class='btn btn-danger'>Sim,
                                                                        remover</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <?php
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan='8'>Nenhum registo encontrado</td>
                                            </tr>
                                        <?php }

                                        mysqli_close($conn);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

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



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>