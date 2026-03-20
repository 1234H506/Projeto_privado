<!-- Filtragem de casas arquivadas -->

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

$sql = "SELECT i.Morada , i.Imagens , i.Comentariosderaridade , i.ID_Imoveis , i.Preco , i.Tipodeimovel , a.nome
FROM imoveis i , agentes a
WHERE i.Agentes_ID_Agentes = a.ID_Agentes AND i.Disponibilidade LIKE 0;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $morada = $row["Morada"];
        $imagens = $row["Imagens"];
        $comentario = $row["Comentariosderaridade"];
        $id = $row["ID_Imoveis"];
        $preco = $row["Preco"];
        $agente = $row["nome"];
        $imovel = $row["Tipodeimovel"];

        exibirCardArquivadas(
            $morada,
            $imagens,
            $preco,
            $comentario,
            $agente,
            $imovel,
            $id
        );
    }

} else {
    echo "0 results";
}

mysqli_close($conn);

function exibirCardArquivadas($titulo, $imagem, $preco, $descricao, $agente, $imovel, $id)
{ ?>

    <div class='col-12 col-md-6 col-lg-4 mb-4'>
        <div class='card shadow mb-4'>

            <div class='card-header py-3'>
                <h6 class='m-0 font-weight-bold text-primary'><?= $titulo; ?></h6>
            </div>

            <div class='card-body'>

                <!-- Imagem -->
                <div class='card-body'>
                    <img src='img/principal/<?= $imagem; ?>' class='img-fluid mb-3 rounded' alt='Imagem do imóvel'>

                    <!-- Preço -->
                    <h6 class='text-primary mt-4'><strong>Preço do imóvel</strong></h6>
                    <p><?= $preco; ?></p>

                    <!-- Agente responsável -->
                    <h6 class='text-primary'><strong>Agente responsável</strong></h6>
                    <p><?= $agente; ?></p>

                    <!-- Descrição do imóvel -->
                    <h6 class='text-primary'><strong>Descrição</strong></h6>
                    <p><?= $descricao; ?></p>

                    <h6 class='text-primary'><strong>Tipo de imóvel</strong></h6>
                    <p><?= $imovel; ?></p>

                    <div class='d-flex justify-content-between'>

                        <!-- DESARQUIVAR -->
                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal'
                            data-target='#modalDesarquivar<?= $id; ?>'>
                            Desarquivar
                        </button>



                        <!-- EXCLUIR -->
                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal'
                            data-target='#modalExcluir<?= $id; ?>'>
                            Excluir
                        </button>

                        <!-- Modal para o butão excluir -->

                        <div class='modal fade' id='modalExcluir<?= $id; ?>' tabindex='-1' role='dialog'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                <div class='modal-content'>

                                    <div class='modal-header'>
                                        <h5 class='modal-title text-danger'>Excluir imóvel</h5>
                                        <button type='button' class='close' data-dismiss='modal'>
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class='modal-body'>
                                        <strong>Atenção:</strong> esta ação é definitiva.<br>
                                        Deseja realmente excluir este imóvel?
                                    </div>

                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>
                                            Não
                                        </button>

                                        <form action='A_excluirCasasarquivadas.php' method='post' class='d-inline'>
                                            <input type='hidden' name='id' value='<?= $id; ?>'>
                                            <button type='submit' class='btn btn-danger'>
                                                Sim, excluir
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <!-- Modal para o butão desarquivar -->

                        <div class='modal fade' id='modalDesarquivar<?= $id; ?>' tabindex='-1' role='dialog'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                <div class='modal-content'>

                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Desarquivar imóvel</h5>
                                        <button type='button' class='close' data-dismiss='modal'>
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class='modal-body'>
                                        Deseja realmente desarquivar este imóvel?
                                    </div>

                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>
                                            Não
                                        </button>

                                        <form action='A_desarquivar_Casa.php' method='post' class='d-inline'>
                                            <input type='hidden' name='id' value='<?= $id; ?>'>
                                            <button type='submit' class='btn btn-success'>
                                                Sim
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col -->
    </div>
    <?php
}
?>

