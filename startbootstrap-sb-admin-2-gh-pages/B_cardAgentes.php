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

$sql = "SELECT * FROM agentes WHERE disponibilidades = 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {

        $nome = $row["nome"];
        $imagens = $row["Imagem"];
        $numero = $row["NdeTelemovel"];
        $servicos = $row["Servicos"];
        $email = $row["Email"];
        $id = $row["ID_Agentes"];
        exibirCardAgente("$nome", "$numero", "$servicos", "$email", "$id", "$imagens");


    }
} else {
    echo "0 results";
}

mysqli_close($conn);

function exibirCardAgente($nome, $numero, $servicos, $email, $id, $imagens)
{
    ?>


    <div class='col-12 col-md-6 col-lg-4 mb-4'>
        <div class='card shadow mb-4'>

            <div class='card-header py-3'>
                <h6 class='m-0 font-weight-bold text-primary'><?= $nome ;?></h6>
            </div>

            <div class='card-body'>
                <div class='text-center mb-3'>
                    <img class='img-fluid rounded-circle' style='width: 150px; height: 150px;' src='img/agents/<?= $imagens ;?>'
                        alt='Foto do agente'>
                </div>

                <h6 class='text-primary mt-4'><strong>Número de telemóvel</strong></h6>
                <p><?= $numero; ?></p>

                <h6 class='text-primary'><strong>Serviços</strong></h6>
                <p><?= $servicos; ?></p>

                <h6 class='text-primary'><strong>Email</strong> </h6>
                <p><?= $email; ?></p>


                <div class='d-flex flex-wrap justify-content-between mt-4'>

                    <!-- Form para alteração de registro do agentes -->
                    <form action='B_alterar_agente.php' method='post' class="mb-2" >
                        <input type='hidden' name='id' value='<?= $id; ?>'>
                        <button type='submit' class='btn btn-primary btn-sm px-3'>Editar</button>
                    </form>

                    <!-- Butão para abrir o modal -->
                    
                        
                        <button type='button' class='btn btn-primary btn-sm mb-2 px-3' data-toggle='modal'
                            data-target='#modalExcluirAgente<?= $id; ?>'>Eliminar
                        </button>

                        <!-- Abre o modal -->
                        <div class='modal fade' id='modalExcluirAgente<?= $id; ?>' tabindex='-1'
                            role='dialog'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                <div class='modal-content'>

                                    <div class='modal-header'>
                                        <h5 class='modal-title text-danger'>Remover o/a agente arquivado</h5>
                                        <button type='button' class='close' data-dismiss='modal'>
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class='modal-body'>
                                        <strong>Atenção:</strong> esta ação é definitiva. <br>
                                        Deseja realmente remover o/a agente?
                                    </div>

                                    <div class='modal-footer'>

                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>
                                            Não
                                        </button>

                                        <form action='B_excluir_agente_consul.php' method='post'
                                            class='d-inline'>
                                            <input type='hidden' name='id' value='<?= $id; ?>'>
                                            <button type='submit' class='btn btn-danger'>
                                                Sim, remover
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                    <!-- Form para arquivar agente  -->
                    
                        <button type='button' class='btn btn-primary btn-sm mb-2 px-3' data-toggle='modal'
                            data-target='#modalArquivarAgente<?= $id; ?>'>Arquivar
                        </button>

                        <div class='modal fade' id='modalArquivarAgente<?= $id; ?>' tabindex='-1' role='dialog'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                <div class='modal-content'>

                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Arquivar agente</h5>
                                        <button type='button' class='close' data-dismiss='modal'>
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class='modal-body'>
                                        Deseja realmente arquivar esse(a) agente?
                                    </div>

                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>
                                            Não
                                        </button>

                                        <form action='B_arquivar_agente_consul.php' method='post' class='d-inline'>
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
            </div>
        </div>
    </div>
    <?php
}
?>