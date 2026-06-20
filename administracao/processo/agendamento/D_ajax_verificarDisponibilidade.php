<?php
// D_ajax_verificarDisponibilidade.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro de conexão']);
    exit;
}

// Função para calcular duração baseada na tipologia
function calcularTempo($tipologia) {
    $minutos = 0;
    switch (strtoupper($tipologia)) {
        case 'T0':
        case 'T1': 
            $minutos = 30; 
            break;
        case 'T2':
        case 'T3': 
            $minutos = 60; 
            break;
        case 'T4': 
            $minutos = 90; 
            break;
        default:   
            $minutos = 120;
    }
    return $minutos + 30; // Soma o buffer de deslocamento/água
}

// Validar inputs
if (!isset($_POST['id_agente'], $_POST['id_imovel'], $_POST['data_visita'])) {
    http_response_code(400);
    echo json_encode(['erro' => 'Parâmetros inválidos']);
    exit;
}

$id_agente = intval($_POST['id_agente']);
$id_imovel = intval($_POST['id_imovel']);
$data_visita = $_POST['data_visita'];

// Validar formato da data
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_visita)) {
    http_response_code(400);
    echo json_encode(['erro' => 'Data inválida']);
    exit;
}

// 1. Duração da NOVA VISITA (baseada na tipologia do imóvel)
$stmt = $conn->prepare("SELECT Tipologia FROM imoveis WHERE ID_Imoveis = ?");
$stmt->bind_param("i", $id_imovel);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    http_response_code(404);
    echo json_encode(['erro' => 'Imóvel não encontrado']);
    exit;
}

$row = $result->fetch_assoc();
$nova_duracao = calcularTempo($row['Tipologia']);
$stmt->close();

// 2. Buscar visitas existentes EXCLUINDO a visita atual (se estiver editando)
// Isso evita verificar colisão consigo mesmo
$id_registro_atual = $_POST['id_registro'] ?? 0;

$stmt = $conn->prepare("
    SELECT v.data, i.Tipologia, v.id_registro
    FROM utilizador_has_imoveis v
    INNER JOIN imoveis i ON v.Imoveis_ID_Imoveis = i.ID_Imoveis
    WHERE DATE(v.data) = ?
    AND v.id_registro != ?
    AND (v.Agentes_ID_Agentes = ? OR v.Imoveis_ID_Imoveis = ?)
    AND v.Status_de_visita != 'finalizado'
");

$stmt->bind_param("siii", $data_visita, $id_registro_atual, $id_agente, $id_imovel);
$stmt->execute();
$result = $stmt->get_result();

$ocupados = [];
while ($row = $result->fetch_assoc()) {
    $ocupados[] = [
        'inicio' => $row['data'],
        'duracao' => calcularTempo($row['Tipologia']),
        'id_registro' => $row['id_registro']
    ];
}
$stmt->close();

// Retornar dados como JSON
header('Content-Type: application/json');
echo json_encode([
    'nova_duracao' => $nova_duracao,
    'ocupados' => $ocupados,
    'sucesso' => true
]);

$conn->close();
?>