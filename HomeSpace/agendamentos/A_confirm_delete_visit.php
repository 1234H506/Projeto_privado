<?php 
include('conexao.php');

$id_visita = $_POST['id'];

$sql = "UPDATE utilizador_has_imoveis SET Status_de_visita = 'cancelado', resultado = 'cancelado' WHERE id_registro = $id_visita";
$conn->query($sql);

header('Location: user_profile.php');
exit;
?>