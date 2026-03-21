<?php 

include("../conexao.php");
include("../assets/class/utilizador.php");

$email = $_POST["email"];

$utilizador = new utilizador(null,null,null,$email,null,null,null);
if ($utilizador->Validacao_De_Recuperacao_De_Senha($email,$conn) === true){
    ?><h1>boa</h1> <?php
} else {
    ?><h1>má</h1> <?php
}


?>