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

if (isset($_POST['id_agente'])) {

    $id_agente = $_POST['id_agente'];

    $sql = "SELECT ID_Imoveis, Morada 
            FROM imoveis 
            WHERE Agentes_ID_Agentes = '$id_agente' 
            AND Disponibilidade = 1";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<option value="">Selecione...</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row["ID_Imoveis"].'">'.$row["Morada"].'</option>';
        }
    } else {
        echo '<option value="">Sem imóveis disponíveis</option>';
    }
}


?>

