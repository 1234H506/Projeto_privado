<!-- Filtragem de casas disponível  -->

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

//  Está na variável de sessão 
 $idimovel = $_SESSION['id_imovel'] ;

// Query para buscar na tabela galeria e imoveis
$sql = "SELECT i.Morada , g.Fotos , g.ID_Galeria FROM galeria g , imoveis i WHERE g.Imoveis_ID_Imoveis = i.ID_Imoveis and g.Imoveis_ID_Imoveis like $idimovel";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $morada = $row["Morada"];
        $imagens = $row["Fotos"];
        $id_galeria = $row["ID_Galeria"];


        exibirCard($morada, $imagens, $id_galeria);

    }
} else {
    echo "0 results";
}

mysqli_close($conn);




function exibirCard($titulo, $imagens, $id_galeria)
{
    // Criamos um ID único para cada modal baseado no ID da galeria
    $modalID = "modalImg" . $id_galeria;
    ?>

    <!-- Card -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div style="height: 250px; overflow: hidden; cursor: pointer;" data-toggle="modal"
                data-target="#<?php echo $modalID; ?>">
                <img src="img/galeria/<?php echo $imagens; ?>" class="card-img-top"
                    style="height: 100%; width: 100%; object-fit: cover; image-rendering: -webkit-optimize-contrast;">
            </div>

            <!-- Morada e botão de excluir -->
            <div class="card-body d-flex flex-column text-center">
                <h4 class="card-title  text-dark mb-3"><?php echo $titulo; ?></h4>
                <div class="mt-auto">
                    <button type="button" class="btn btn-outline-danger btn-sm btn-block" data-toggle="modal"
                        data-target="#modalExcluirImagem<?= $id_galeria ?>">
                        <i class="fas fa-trash-alt mr-1"></i> Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para exibir a imagem inteira   -->
    <div class="modal fade" id="<?php echo $modalID; ?>" tabindex="-1" role="dialog" aria-hidden="true"
        onclick="$('#<?php echo $modalID; ?>').modal('hide');">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content" style="background: none; border: none; box-shadow: none;">
                <div class="modal-body p-0 text-center">
                    <img src="img/galeria/<?= $imagens; ?>" class="img-fluid rounded shadow-lg" style="max-height: 95vh; width: auto; 
                                image-rendering: high-quality; 
                                image-rendering: -webkit-optimize-contrast;
                                display: inline-block;">

                    <p class="text-white mt-2 small">Clique em qualquer lugar fora para voltar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de excluir foto de galeria -->
    <div class='modal fade' id='modalExcluirImagem<?= $id_galeria ?>' tabindex='-1' role='dialog'>
        <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title text-danger'>Eliminar imagem</h5>
                    <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <strong>Atenção:</strong> esta ação é definitiva. <br>
                    Deseja realmente remover esta imagem?
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                    <form action='A_galeria_imagem_excluir_consul.php' method='post' class='d-inline'>
                        <input type='hidden' name='id' value='<?php echo $id_galeria ?>'>
                        <button type='submit' class='btn btn-danger'>Sim, remover</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
}
?>