<?php
 include("verificacaoDeLogin.php");


// Tive que fazer isso para que o id passasse pelo link do botão ADD galeria
if (isset($_POST["id"])) {
    // Se o id foi passado, pega o valor e coloca na variável de sessão
    $_SESSION['id_imovel'] = $_POST["id"];
}

// Se o idimovel está na sessão, você pode usá-lo diretamente
if (isset($_SESSION['id_imovel'])) {
    $idimovel = $_SESSION['id_imovel'];
    // Aqui você pode usar $idimovel para o que precisar
} else {
    header("Location: A_tablesCasas.php");
}

 
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

                            <li class="breadcrumb-item text-muted">Galeria</li>
                            <li class="breadcrumb-item active font-weight-bold" aria-current="page">Imagens
                            </li>

                            <a href="A_addImagens.php" class="btn btn-sm btn-primary shadow-sm ml-auto">
                                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Adicionar imagens 
                            </a>

                        </ol>
                    </nav> 

                    </div>
                    

                    <!-- Cards -->

                    <div class="container">
                        <div class="row" id="cards">

                            <?php
                            include("A_cardGaleriaCasas.php");
                            ?>


                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->

        </div>


        <!-- Scroll to Top -->
        <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>



        <!-- Scripts -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <script src="js/sb-admin-2.min.js"></script>

        

</body>

</html>