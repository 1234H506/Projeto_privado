<?php
session_start(); // Inicia a sessão

// Verifica se o utilizador está autenticado
if (!isset($_SESSION["email"]) && !isset($_SESSION["admin"]))  {
    // Redireciona para a página de login se não estiver autenticado
    header("Location: /Html%20em%20php/HomeSpace/HomeSpace/LOGIN.php");
    exit();
}

// O que trás do login
// $email = $_SESSION["email"];
// $nome = $_SESSION["nome"];
$id_utilizador = $_SESSION["id"];







// parte especialmente para add_Imagens
// Para levar o id gerado e a morada

$id_imovel = $_SESSION['id_imovel'] ?? null;
$morada = $_SESSION['morada'] ?? null;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

// criar a conexão com a BD
$conn = new mysqli($servername, $username, $password, $dbname);

// Check conexão
if ($conn->connect_error) {
    die("Falha ao tentar conectar: " . $conn->connect_error);
}

// Puxado os dados do utilizador
$sql ="SELECT * FROM utilizador WHERE ID_Utilizador = '$id_utilizador'";
// Executamos o query e o que vem fica armazenado na variável resultado
$resultado = $conn->query($sql);
// Pegamos a linha de dados que vem
$row = $resultado->fetch_assoc();

// Armazenamos o que pegamos na query
$nomeDoUsuarioLogado=$row['Nome'];
$telemovelDoUsuarioLogado=$row['nr_telemovel'];
$emailDoUsuarioLogado=$row['Email'];
$sexoDoUsuarioLogado=$row['Sexo'];
$imagemDoUsuarioLogado=$row['Imagem'];

 
?>