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




// 1º Eliminar todas as fotos da galeria com esse id
$sql1 = "DELETE FROM galeria WHERE Imoveis_ID_Imoveis like $id;";
// Executar a query
$conn->query($sql1);

// 2ª Eliminar o imovél
$sql2="DELETE FROM imoveis WHERE ID_Imoveis like $id;";
// Executar a query
$conn->query($sql2);
// Redireciono para página desejada
header("Location: A_tablesCasas.php");
// Essa a conexão ao banco de dados 
exit;


?>