<?php
include("../../verificacaoDeLogin.php");
include("../../config.php/base.php");
include("../../../HomeSpace/reutilizaveis/Funcoes_util.php");

$id_agentes = $_POST['id'];


$sql = "SELECT * FROM `agentes` WHERE ID_Agentes= $id_agentes";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {

        $nomeAgente = $row['nome'];
        $tel = $row['NdeTelemovel'];
        $servicos = $row['Servicos'];
        $email = $row['Email'];
        $imagem = $row['Imagem'];
        $sexo = $row['Sexo'];


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

    <title>Admin - Imóvel</title>

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

        <?php include("../../E_sidebar.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include("../../E_topbar.php"); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <nav aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb bg-white shadow-sm border-left-primary d-flex align-items-center mb-5">

                            <li class="breadcrumb-item text-muted">Agentes</li>
                            <li class="breadcrumb-item active font-weight-bold" aria-current="page">Alterar agente
                            </li>


                        </ol>
                    </nav>

                </div>
                <!-- /.container-fluid -->

                <!-- Formulário centralizado -->
                <div class="d-flex justify-content-center mt-4">
                    <div class="col-md-8 col-lg-6">


                        <form class="row g-3" id="alterarAgente" action="../../processo/agente/B_alterar_agentes_consul.php" method="POST"
                            enctype="multipart/form-data">


                            <!--Pegamos id do agente-->
                            <input type="hidden" name="id" value="<?= $id_agentes ?>">

                            <!-- Nome -->
                            <div class="col-12 mt-3">
                                <label for="inputNome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="inputNome" name="nome" autocomplete="off"
                                    value="<?= $nomeAgente ?>" required>
                            </div>

                            <!-- Número de Telemóvel -->
                            <div class="col-6 mt-3">
                                <label for="inputNumero" class="form-label">Número de Telemóvel</label>
                                <input type="text" class="form-control" id="inputNumero" name="numero"
                                    value="<?= $tel ?>" maxlength="9"  required>
                            </div>

                            <!-- Email -->
                            <div class="col-6 mt-3">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email"
                                    value="<?= $email ?>" required>
                            </div>

                            <!-- Serviços -->
                            <div class="col-6 mt-3">
                                <label for="inputServicos" class="form-label">Serviços</label>
                                <select class="form-control" id="inputServicos" name="servicos"
                                    value="<?= $servicos ?>" required>
                                    <?php
                                    $lista = ["Arrendamento", "Vendas", "Compras"];
                                    foreach ($lista as $value) {
                                        ?>
                                        <option value="<?= $value; ?>" <?php if (strcasecmp($value, $servicos) === 0)
                                               echo 'selected'; ?>>
                                            <?= $value; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Sexo -->
                            <div class="col-6 mt-3">
                                <label for="inputSexo" class="form-label">Sexo</label>
                                <select class="form-control" id="inputSexo" name="sexo"  required>
                                    <option value="0" <?= ($sexo == "Masculino") ? 'selected' : ''; ?>>Masculino
                                    </option>
                                    <option value="1" <?= ($sexo == "Feminino") ? 'selected' : ''; ?>>Feminino
                                    </option>
                                </select>
                            </div>

                            

                            <!-- Imagens -->
                            <div class=" col-12 mt-3 ">
                                <label for="inputImagem" class="form-label">Imagens (URL)</label>
                                <input type="file" class="form-control" id="inputImagem" name="inputImagem" value="">

                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> Selecione uma imagem
                                    PNG.
                                </small>
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
        </div>

        <!--End of Formulário-->

    </div>
    <!-- End of Main Content -->



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
                    <button type="submit" class="btn btn-success" form="alterarAgente">
                        Sim
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- script importante para verifica se as validação estão sendo feitas  -->
    <script>
        document.getElementById('btnAlterar').addEventListener('click', function () {
            var form = document.getElementById('alterarAgente');

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
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

</body>

</html>