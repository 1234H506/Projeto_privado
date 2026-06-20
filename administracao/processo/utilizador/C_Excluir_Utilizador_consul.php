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

// Verificamos se recebemos um post com o id do agente a ser deletado
$id = $_POST['id'];

// Preparar o comando sql para deletar o imóvel pelo id
$sql ="DELETE FROM utilizador WHERE ID_Utilizador = '$id'";
$conn->query($sql);
// Redireciono para página desejada
header("Location: ../../templates/utilizador/C_tablesUtilizador.php");
// saí
exit;
?>