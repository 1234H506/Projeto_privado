<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];


// Sql para remover os imóvel selecionado
 $sql = "DELETE FROM utilizador_has_imoveis WHERE id_registro = $id;";
 $conn->query($sql);
 header("Location: ../../templates/agendamento/D_tablesVisitas.php");
 exit;
?>
