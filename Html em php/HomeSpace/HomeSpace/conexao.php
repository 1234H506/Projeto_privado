<?php
// variável de conexão ao banco de dados 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

//  Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão , se a conexão falha aparece uma mensagem 
if ($conn->connect_error) {
    die("Falha ao tentar conectar" . $conn->connect_error);
}
?>