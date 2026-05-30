<!-- Filtragem de casas disponível  -->

<?php


$sql = "SELECT i.Morada , i.Imagens , i.Comentariosderaridade , i.ID_Imoveis , i.Preco , i.Tipodeimovel , a.nome
FROM imoveis i , agentes a
WHERE i.Agentes_ID_Agentes = a.ID_Agentes AND i.Disponibilidade LIKE 1;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {

        $morada = $row["Morada"];
        $imagens = $row["Imagens"];
        $comentario = $row["Comentariosderaridade"];
        $id = $row["ID_Imoveis"];
        $preco = $row["Preco"];
        $agente = $row["nome"];
        $imovel = $row["Tipodeimovel"];

        

        $preco_formatado = number_format($preco, 2, ',', '.');
        exibirCard($morada, $imagens, $preco_formatado, $comentario, $agente, $imovel, $id);


    }
} else {
    echo "0 results";
}


mysqli_close($conn);


function exibirCard($titulo, $imagem, $preco, $descricao, $agente, $imovel, $id)
{ ?>
    <div class='col-12 col-md-6 col-lg-4 mb-4'>
        <div class='card shadow mb-4'>
            <div class='card-header py-3'>
                <h6 class='m-0 font-weight-bold text-primary'><?= $titulo; ?></h6>
            </div>

            <div class='card-body'>
                <img src='img/principal/<?= $imagem ?>' class='img-fluid mb-3 rounded' alt='Imagem do imóvel'>

                <h6 class='text-primary mt-4'><strong>Preço do imóvel</strong></h6>
                <p><?= $preco; ?></p>

                <h6 class='text-primary'><strong>Agente responsável</strong></h6>
                <p><?= $agente ?></p>

                <h6 class='text-primary'><strong>Descrição</strong></h6>
                <p><?= $descricao ?></p>

                <h6 class='text-primary'><strong>Tipo de imóvel</strong></h6>
                <p><?= $imovel ?></p>

                <div class='d-flex flex-wrap justify-content-between mt-5 w-100' style="gap: 5px;">
                    
                    <form action='A_alterar_registro.php' method='post' class='d-inline'>
                        <input type='hidden' name='id' value='<?= $id ?>'>
                        <button type='submit' class='btn btn-primary btn-sm px-2'>Editar</button>
                    </form>
                    

                    <form action='A_galeria_imagem.php' method='post' class='d-inline'>
                        <input type='hidden' name='id' value='<?= $id ?>'>
                        <button type='submit' class='btn btn-primary btn-sm px-2'>Galeria</button>
                    </form>

                    <button type='button' class='btn btn-primary btn-sm px-2' data-toggle='modal'
                            data-target='#modalArquivarImovel<?= $id ?>'>Arquivar</button>

                    <button type='button' class='btn btn-primary btn-sm px-2' data-toggle='modal'
                            data-target='#modalExcluirimovel<?= $id ?>'>Eliminar</button>
                </div>

                <div class='modal fade' id='modalArquivarImovel<?= $id ?>' tabindex='-1' role='dialog'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title'>Arquivar imóvel</h5>
                                <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                            </div>
                            <div class='modal-body'>Deseja realmente arquivar este imóvel?</div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                                <form action='A_arquivar_imovel_consul.php' method='post' class='d-inline'>
                                    <input type='hidden' name='id' value='<?php echo $id ?>'>
                                    <button type='submit' class='btn btn-success'>Sim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='modal fade' id='modalExcluirimovel<?= $id ?>' tabindex='-1' role='dialog'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title text-danger'>Eliminar o imóvel</h5>
                                <button type='button' class='close' data-dismiss='modal'><span>&times;</span></button>
                            </div>
                            <div class='modal-body'>
                                <strong>Atenção:</strong> esta ação é definitiva. <br>
                                Deseja realmente remover este imóvel?
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Não</button>
                                <form action='A_excluir_imovel_consul.php' method='post' class='d-inline'>
                                    <input type='hidden' name='id' value='<?php echo $id ?>'>
                                    <button type='submit' class='btn btn-danger'>Sim, remover</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div> 
        </div> 
    </div> 
<?php
}