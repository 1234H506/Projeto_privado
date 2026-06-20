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

$id = $_POST['id'];

// Filtra o imovel 
$sql= "UPDATE imoveis SET Disponibilidade = 0  WHERE ID_Imoveis = '$id'";

// Executo a váriavel
$conn->query($sql);

// Redireciono para listagem de imóveis
header("Location: ../../templates/imoveis/A_tablesCasas.php");
exit;

?>