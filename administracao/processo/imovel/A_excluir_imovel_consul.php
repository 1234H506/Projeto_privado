<?php
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

// Pegamos o id em post
$id = $_POST['id'];

$sql_fotos = "SELECT Fotos FROM galeria WHERE Imoveis_ID_Imoveis like $id;";
$result = mysqli_query($conn,$sql_fotos);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $imagem = $row['Fotos'];
        $caminho = "../../img/galeria/" . $imagem;

        if(file_exists($caminho)){
            unlink($caminho);
        }
    }
}

$sql_galeria = "DELETE FROM galeria WHERE Imoveis_ID_Imoveis = $id;";
$conn->query($sql_galeria);

$sql_ft_principal = "SELECT Imagens FROM imoveis WHERE ID_Imoveis like $id";
$result_pr = mysqli_query($conn,$sql_ft_principal);
if(mysqli_num_rows($result_pr)>0){
    $row = mysqli_fetch_assoc($result_pr);
    $imagem_principal = $row['Imagens'];
}

$caminho_principal = "../../img/principal/".$imagem_principal;


if (file_exists($caminho_principal)){
    unlink($caminho_principal);
}else{
    ?>
    <script>
      alert('Erro ao tentar achar o arquivo.');
      window.location.href = '../../templates/imoveis/A_tablesCasas.php';
    </script>
    <?php
    exit;
}

// 2ª Eliminar o imovél
$sql2="DELETE FROM imoveis WHERE ID_Imoveis like $id;";
// Executar a query
$conn->query($sql2);
// Redireciono para página desejada
header("Location: ../../templates/imoveis/A_tablesCasas.php");
// Essa a conexão ao banco de dados 
exit;


?>