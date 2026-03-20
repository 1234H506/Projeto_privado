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

$id = $_POST['id'];

// Filtra o imovel 
$sql= "UPDATE imoveis SET Disponibilidade = 1  WHERE ID_Imoveis = '$id'";

// Executo a váriavel
$conn->query($sql);

// Redireciono para listagem de imóveis
header("Location: A_tablesCasasArquivadas.php");
exit;

?>