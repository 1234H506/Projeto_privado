<?php
// D_ajax_getImoveis.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo '<option value="">Erro ao conectar</option>';
    exit;
}

// Validar entrada
if (!isset($_POST['id_agente'])) {
    http_response_code(400);
    echo '<option value="">Erro: Agente não especificado</option>';
    exit;
}

$id_agente = intval($_POST['id_agente']);

// Usar prepared statement para segurança
$stmt = $conn->prepare("
    SELECT ID_Imoveis, Morada 
    FROM imoveis 
    WHERE Agentes_ID_Agentes = ? 
    AND Disponibilidade = 1
    ORDER BY Morada ASC
");

if (!$stmt) {
    http_response_code(500);
    echo '<option value="">Erro na consulta</option>';
    exit;
}

$stmt->bind_param("i", $id_agente);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<option value="">Selecione...</option>';
    while ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row["ID_Imoveis"]);
        $morada = htmlspecialchars($row["Morada"]);
        echo "<option value='$id'>$morada</option>";
    }
} else {
    echo '<option value="">Sem imóveis disponíveis para este agente</option>';
}

$stmt->close();
$conn->close();
?>