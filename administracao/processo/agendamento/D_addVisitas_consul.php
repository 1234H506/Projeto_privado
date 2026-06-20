<?php
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

// Verificação se o formulário foi enviado
$id_registro = $_POST["id"];
$nomeDoVisitante = $_POST["nomeDoVisitante"];
$NomeDoAgente = $_POST["NomeDoAgente"];
$NomeDoImovel = $_POST["NomeDoImovel"];
$dataDeRegistro = $_POST["dataDeRegistro"];
$hora = $_POST["horaDeRegistro"];
$comentario = $_POST["comentarios"];


// para salvar o que vem do um input como datetime no banco de dado
$data_hora = $dataDeRegistro . ' ' . $hora . ':00';


 // Inserir dados na tabela utilizador_has_imoveis 


 $sql = "INSERT INTO utilizador_has_imoveis 
 (id_registro, Utilizador_ID_Utilizador , Imoveis_ID_Imoveis, Agentes_ID_Agentes, data) 
 VALUES ('$id_registro', '$nomeDoVisitante', '$NomeDoImovel', '$NomeDoAgente', '$data_hora')";

 //Se os dados for registrado
    if($conn->query($sql) === TRUE){
      header("Location: ../../templates/agendamento/D_tablesVisitas.php");
      exit();
    }
    

   // Se os dados não for registrado
    else{
      header("Location: D_addVisitas.php");
      echo"Error: " . $sql . "<br>" . $conn->error ;
    }
    $conn->close();

?>