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

    <title>Admin - HomeSpace</title>

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

                            <li class="breadcrumb-item text-muted">Imóvel</li>
                            <li class="breadcrumb-item active font-weight-bold" aria-current="page">Imoveís Arquivados
                            </li>


                        </ol>
                    </nav>


                    <div class="d-flex justify-content-center mb-4">
                        <input class="form-control col-11 col-sm-9 col-md-6 col-lg-4" type="search"
                            placeholder="Digite a morada do imóvel" aria-label="Search" id="search" data-search
                            data-target="#cards" data-item=".card" autocomplete="off">
                    </div>
                    <!-- Cards -->

                    <div class="container">
                        <div class="row" id="cards">

                            <?php
                            include("A_cardCasasArquivadas.php");
                            ?>

                        </div>
                    </div>
                </div>
                <!-- End Page Content -->

            </div>
        </div>
    </div>


    <!-- Scroll to Top -->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>



    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

    <script src="js/confirmacao.js"></script>

</body>

</html>