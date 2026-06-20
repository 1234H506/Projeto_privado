<?php
include("../../verificacaoDeLogin.php");
include("../../config.php/base.php")

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
    <link href="../../css/sb-admin-2.css" rel="stylesheet">


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

                <div class="container-fluid mb-5">

                    <nav aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb bg-white shadow-sm border-left-primary">
                            <li class="breadcrumb-item text-muted">Imóvel</li>
                            <li class="breadcrumb-item active font-weight-bold" aria-current="page">Adicionar Imóvel
                            </li>
                        </ol>
                    </nav>
                    <!-- /.container-fluid -->

                    <!--Formulário centralizado-->
                    <div class="d-flex justify-content-center mt-4">
                        <div class="col-12 col-md-8 col-lg-6">

                            <form id="addImoveis" class="row g-3 " action="../../processo/imovel/A_addImovel-consul.php" method="post"
                                enctype="multipart/form-data">

                                <!-- Freguesia -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputFreguesia" class="form-label">Freguesia</label>
                                    <input type="text" class="form-control" id="inputFreguesia" name="inputFreguesia"
                                        autocomplete="off" required>
                                </div>

                                <!-- Morada -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputMorada" class="form-label">Morada</label>
                                    <input type="text" class="form-control" id="inputMorada" name="inputMorada"
                                        autocomplete="off" required>
                                </div>

                                <!-- Concelho -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputConcelho" class="form-label">Concelho</label>
                                    <input type="text" class="form-control" id="inputConcelho" name="inputConcelho"
                                        autocomplete="off" required>
                                </div>

                                <!-- lembra o name importa para levar a variável post -->
                                <!-- Distrito -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputDistrito" class="form-label">Distrito</label>
                                    <select class="form-control" id="inputDistrito" name="inputDistrito" required>
                                        <option value="">Selecione um distrito</option>
                                        <?php
                                        $lista = [
                                            "Aveiro",
                                            "Beja",
                                            "Braga",
                                            "Bragança",
                                            "Castelo Branco",
                                            "Coimbra",
                                            "Évora",
                                            "Faro",
                                            "Guarda",
                                            "Leiria",
                                            "Lisboa",
                                            "Portalegre",
                                            "Porto",
                                            "Santarém",
                                            "Setúbal",
                                            "Viana do Castelo",
                                            "Vila Real",
                                            "Viseu"
                                        ];
                                        foreach ($lista as $distrito) {
                                            ?>
                                            <option><?= $distrito; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Código Postal -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputCodigoPostal" class="form-label">Código Postal</label>
                                    <input type="text" class="form-control" id="inputCodigoPostal" name="inputCodigo"
                                        autocomplete="off" maxlength="7" required>
                                </div>

                                <!-- Área útil -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputAreaUtil" class="form-label">Área útil (m²)</label>
                                    <input type="number" class="form-control" id="inputAreaUtil" min="0"
                                        name="inputArea" autocomplete="off" required>
                                </div>

                                <!-- Tipologia -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputTipologia" class="form-label">Tipologia</label>
                                    <select class="form-control" id="inputTipologia" name="inputTipologia" required>
                                        <option value="">Selecione a tipologia</option>
                                        <?php
                                        $tiposDeTipologia = ["T0", "T1", "T2", "T3", "T4", "T5+"];
                                        foreach ($tiposDeTipologia as $value) {
                                            ?>
                                            <option><?= $value ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Número de entradas -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputNrEntradas" class="form-label">Número de Entradas</label>
                                    <input type="number" class="form-control" id="inputNrEntradas" min="0"
                                        name="inputEntradas" autocomplete="off" required>
                                </div>

                                <!-- Capacidade da garagem -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputGaragem" class="form-label">Capacidade Garagem</label>
                                    <input type="text" class="form-control" id="inputGaragem" name="inputGaragem"
                                        autocomplete="off" required>
                                </div>



                                <!-- Tipo de imóvel -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputTipoImovel" class="form-label">Tipo de Imóvel</label>
                                    <select class="form-control" id="inputTipoImovel" name="inputTipo" required>
                                        <option value="">Selecione o tipo de imóvel</option>
                                        <?php
                                        $categoria = ["Casa", "Apartamento", "Vivenda", "Quinta"];
                                        foreach ($categoria as $value) {
                                            ?>
                                            <option><?= $value ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Estado -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputEstado" class="form-label">Estado</label>
                                    <select class="form-control" id="inputEstado" name="inputEstado" required>
                                        <option value="">Selecione o estado</option>
                                        <?php
                                        $estado = ["Novo", "Bom estado", "Usado"];
                                        foreach ($estado as $value) {
                                            ?>
                                            <option><?= $value ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Preço -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputPreco" class="form-label">Preço (€)</label>
                                    <input type="number" class="form-control" id="inputPreco" min="0" name="inputPreco"
                                        required>
                                </div>

                                <!-- Data de registro -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputDataRegistro" class="form-label">Data de Registro</label>
                                    <input type="date" class="form-control" id="inputDataRegistro" name="inputData"
                                        required>
                                </div>

                                <!-- Agente responsável -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputAgente" class="form-label">Agente responsável</label>
                                    <select class="form-control" id="inputAgente" name="inputAgente" required>
                                        <option value="">Selecione um agente</option>
                                        <?php
                                        $sql = "SELECT ID_Agentes,nome FROM agentes ORDER BY nome ASC";
                                        $result = $conn->query($sql);

                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["ID_Agentes"] . '">' . $row["nome"] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">Nenhum registro de agente encontrado</option>';
                                        }

                                        ?>
                                    </select>
                                </div>


                                <!-- Imagens -->
                                <div class=" col-12 mt-3 ">
                                    <label for="inputImagens" class="form-label">Imagens (URL)</label>
                                    <input type="file" class="form-control" id="inputImagens" name="inputImagens" accept="image/jpeg, image/jpg, image/png, image/webp"
                                        required>

                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i> Selecione uma imagem
                                        (JPG, PNG ou WEBP).
                                    </small>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i> Limite de arquivo de 500KB
                                    </small>
                                </div>


                                <!-- Comentários / Raridade -->
                                <div class="col-md-12 mt-3">
                                    <label for="inputComentarios" class="form-label">Comentários / Raridade</label>
                                    <input type="text" class="form-control" id="inputComentarios" name="inputComentario"
                                        autocomplete="off" required>
                                </div>

                                <!-- Sótão -->
                                <div class="col-md-6 mt-3">
                                    <label for="inputSotao" class="form-label">Sótão</label>
                                    <select id="inputSotao" class="form-select" name="sotao">
                                        <option value="0" selected>Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>

                                <!-- Elevador -->
                                <div class="col-md-6 mt-3 ">
                                    <label for="inputElevador" class="form-label">Elevador</label>
                                    <select id="inputElevador" class="form-select" name="elevador">
                                        <option value="0" selected>Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>


                                <!-- Botão -->
                                <div class="col-12 text-center mt-5 mb-5">
                                    <button type="button" class="btn btn-primary px-5" id="btnAdicionar">Publicar
                                        imóvel</button>
                                </div>

                            </form>
                            <!--End of Formulário-->

                        </div>
                    </div>


                </div>
            </div>

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
                            <button type="submit" class="btn btn-success" form="addImoveis">

                                Sim
                            </button>
                        </div>

                    </div>
                </div>
            </div>


            <!-- script importante para verifica se as validação estão sendo feitas  -->
            <script>
                document.getElementById('btnAdicionar').addEventListener('click', function () {
                    var form = document.getElementById('addImoveis');

                    if (form.checkValidity()) {
                        // Só abre o modal se tudo estiver correto
                        $('#confirmarModal').modal('show');
                    } else {
                        // Mostra os erros
                        form.reportValidity();
                    }
                });
            </script>

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>



            <!-- Bootstrap core JavaScript-->
            <script src="../../vendor/jquery/jquery.min.js"></script>
            <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../../js/sb-admin-2.min.js"></script>

            <!-- Script para não permitir registro que não seja em data futuras  -->
            <script src="../../js/confirmacao.js"></script>

</body>

</html>