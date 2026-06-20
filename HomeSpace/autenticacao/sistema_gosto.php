<?php 
session_start();
include("conexao.php");

// se NÃO estiver autenticado, redireciona com parâmetro especial
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    header("Location: 404.php?erro=login_required");
    exit();
}

$get_id_utilizador = $_SESSION["id"];


$get_gosto = "SELECT * FROM gosto g, imoveis i , utilizador u WHERE i.ID_Imoveis = g.ID_Imoveis AND u.ID_Utilizador=g.ID_Utilizador AND u.ID_Utilizador = $get_id_utilizador";
$stmt = $conn->prepare($get_id_utilizador);
$stmt->execute();
$result = $stmt->get_result();
return $result

?>