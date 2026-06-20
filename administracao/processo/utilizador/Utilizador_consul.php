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


// Seleciona o banco de dados e os valores que queremos
$sql =("SELECT ID_Utilizador,Nome,Nr_Telemovel,Password,Email FROM utilizador ");
$result = $conn->query($sql);
?>