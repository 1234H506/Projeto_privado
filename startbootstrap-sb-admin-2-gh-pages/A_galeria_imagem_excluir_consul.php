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

$sql = "DELETE FROM galeria WHERE ID_Galeria = '$id_galeria'";
$conn->query($sql);
// Redireciono para página desejada
header("Location: A_galeria_imagem.php");
// saí
exit;

?>