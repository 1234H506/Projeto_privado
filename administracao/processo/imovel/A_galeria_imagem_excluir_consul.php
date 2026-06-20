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

$id_galeria = $_POST["id"];


$sql_ft_principal = "SELECT Fotos FROM galeria WHERE ID_Galeria = $id_galeria";
$result_pr = mysqli_query($conn,$sql_ft_principal);
if(mysqli_num_rows($result_pr)>0){
    $row = mysqli_fetch_assoc($result_pr);
    $imagem_principal = $row['Fotos'];
}


$caminho_principal = "../../img/galeria/".$imagem_principal;


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
$sql2="DELETE FROM fotos WHERE ID_Galeria = $id_galeria";

// Redireciono para página desejada
header("Location: ../../templates/imoveis/A_tablesCasas.php");
// saí
exit;

?>