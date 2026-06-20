<?php
session_start();
// se NÃO estiver autenticado, redireciona com parâmetro especial
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
  header("Location: ../pagina/404.php?erro=login_required");
  exit();
}

include ("../reutilizaveis/conexao.php");
include("../assets/class/comentario.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $Id_usuario = $_POST["Utilizador"];
  $Sobre_assunto = $_POST["subject"];
  $Texto_Inserido = $_POST["message"];

  // Criar objeto
  $comentario = new Comentarios($Id_usuario,$Sobre_assunto,$Texto_Inserido);

  // condição para salvar
  if($comentario->salvar($conn)){
    header("Location: ../pagina/contact.php");
    exit();
  }else{
    header("Location: ../pagina/contact.php");
    exit();
  }

}
?>