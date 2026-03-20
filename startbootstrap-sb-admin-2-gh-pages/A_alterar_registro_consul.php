<?php

//  1º Faxz a conexão com banco de dados 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

// cria a conexão com o BD
$conn = new mysqli($servername, $username, $password, $dbname);
// Check conexão
if ($conn->connect_error) {
    die("Falha ao tentar conectar" . $conn->connect_error);
}

// 2ª Recupara os dados via POST da página alterior
// Recuperar o valor do id do metodo get 
// Recolha dos campos 
$id = $_POST['id'];
$freguesia = $_POST["inputFreguesia"];
$morada = $_POST['inputMorada'];
$concelho = $_POST['inputConcelho'];
$distrito = $_POST['inputDistrito'];
$codigo_postal = $_POST['inputCodigo'];
$area_util = (float) $_POST['inputArea'];
$tipologia = $_POST['inputTipologia'];
$nr_entradas = (int) $_POST['inputEntradas'];
$capacidade_garagem = (int) $_POST['inputGaragem'];
$elevador = (int) $_POST['elevador'];
$tipo_imovel = $_POST['inputTipo'];
$estado = $_POST['inputEstado'];
$preco = (float) $_POST['inputPreco'];
$data_registro = $_POST['inputData'];
$nomeImagem = $_FILES["inputImagens"]["name"];
$sotao = (int) $_POST['sotao'];
$comentarios_raridade = $_POST['inputComentarios'];
$Agente = $_POST['inputAgente'];





// 3º Verificação da imagem 
// Se o ficheiro enviado pelo campo inputImagens existir e se não tiver ocorrido nenhum erro durante o upload.
if (isset($_FILES['inputImagens']) && $_FILES['inputImagens']['error'] === 0) {


    // Faça isso 
    $nome_arquivos = $_FILES['inputImagens']['name'];

    // Essa linha pega a extensão do arquivo e a transforma em letras minúsculas.
    $imageFileType = strtolower(pathinfo($nome_arquivos, PATHINFO_EXTENSION));


    // GERA O NOME ÚNICO (Sua ideia aplicada)
    $novo_nome = "capa_" . date("YmdHis") . "_" . uniqid() . "." . $imageFileType;

    // Local onde será adicionado 
    $target_dir = "img/principal/";


    // Concatena a variável para obter um caminho
    $target_file = $target_dir . $novo_nome;


    $uploadOk = 1;

    // Validação de Imagem Real
    $check = getimagesize($_FILES['inputImagens']['tmp_name']);
    if ($check === false) {
        $uploadOk = 0;
            ?>
        <script> 
        alert('Imagem não foi considerada real.');
         window.location.href = 'A_addImovel.php';
          </script>
        <?php
         exit;
    }

    // Validação de Tamanho (500KB) - Removido o [$i] que dava erro
    if ($_FILES["inputImagens"]["size"] > 500000) {
        $uploadOk = 0;
         ?>
        <script> 
        alert('Imagem foi considerada com tamanho muito grande.');
         window.location.href = 'A_addImovel.php';
          </script>
        <?php
         exit;
    }

    // Validação de Formato
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "webp"])) {
        $uploadOk = 0;
         ?>
        <script> 
        alert('Imagem está num formato não recomendado.');
         window.location.href = 'A_addImovel.php';
          </script>
        <?php
         exit;
    }

    // Atualiza os valores que foram alterados 
    // Faz o uplode do dados novos com imagem nova
    if ($uploadOk === 1 && isset($_FILES["inputImagens"]["name"])) {
        $sql = "UPDATE imoveis SET Freguesia = '$freguesia', Morada = '$morada',Concelho = '$concelho',Distrito = '$distrito',Codigopostal = '$codigo_postal',Areautil = '$area_util',Tipologia = '$tipologia',Ndeentradas = '$nr_entradas',Capacidadedegaragem = '$capacidade_garagem',Elevador = '$elevador',Tipodeimovel = '$tipo_imovel',Estado = '$estado',Preco = '$preco',Dataderegistro = '$data_registro',Imagens = '$novo_nome',Sotao = '$sotao',Comentariosderaridade = '$comentarios_raridade' , Agentes_ID_Agentes = '$Agente'  WHERE ID_Imoveis = '$id' ";

        if($conn->query($sql) === TRUE){ 
            if (!move_uploaded_file($_FILES['inputImagens']['tmp_name'], $target_file)) {
            ?>
        <script> 
        alert('O uplode foi salvo no banco de dados , mas , imagem no foi para o arquivo.');
         window.location.href = 'A_tablesCasas.php';
          </script>
        <?php
         exit;
         
         }
        }
        
    }
}


// 4º Faz o uplode sem a imagem 
else {
    // Atualiza os valores que foram alterados menos imagens
    $sql = "UPDATE imoveis SET Freguesia = '$freguesia', Morada = '$morada',Concelho = '$concelho',Distrito = '$distrito',Codigopostal = '$codigo_postal',Areautil = '$area_util',Tipologia = '$tipologia',Ndeentradas = '$nr_entradas',Capacidadedegaragem = '$capacidade_garagem',Elevador = '$elevador',Tipodeimovel = '$tipo_imovel',Estado = '$estado',Preco = '$preco',Dataderegistro = '$data_registro',Sotao = '$sotao',Comentariosderaridade = '$comentarios_raridade' , Agentes_ID_Agentes = '$Agente'  WHERE ID_Imoveis = '$id' ";
    $conn->query($sql);
    ?>
    <script> 
        alert('Atualização feitas com sucesso.');
         window.location.href = 'A_tablesCasas.php';
          </script>
        <?php
         exit;
}

?>
<script> 
        alert('Atualização feitas com sucesso.');
         window.location.href = 'A_tablesCasas.php';
          </script>
        <?php
         exit;


?>