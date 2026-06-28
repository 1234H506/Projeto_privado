<?php
// forms/A_ajax_horarios_disponiveis.php

session_start();
include("../config.php/base.php");
include("../reutilizaveis/conexao.php");

date_default_timezone_set('Europe/Lisbon');

// Validar entrada
if (!isset($_POST['data_visita']) || !isset($_POST['id_agente'])) {
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'erro' => 'Parâmetros inválidos']);
    exit;
}

$data_visita = $_POST['data_visita'];
$id_agente = intval($_POST['id_agente']);

// Validar formato da data
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_visita)) {
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'erro' => 'Data inválida']);
    exit;
}

// Verificar se a data é pelo menos amanhã
$hoje = new DateTime('now', new DateTimeZone('Europe/Lisbon'));
$hoje->setTime(0, 0, 0); // ← normaliza para meia-noite
$data_selecionada = new DateTime($data_visita, new DateTimeZone('Europe/Lisbon'));
$data_selecionada->setTime(0, 0, 0); // ← garante comparação só de datas

if ($data_selecionada <= $hoje) {
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'erro' => 'Data deve ser no futuro']);
    exit;
}

// ==================== HORÁRIOS DISPONÍVEIS ====================
// Manhã: 8h às 13h (a cada 30 min)
// Tarde: 14h às 18h (a cada 30 min)

$horarios_disponiveis = [];

// Gerar horários manhã (8:00 até 13:00)
for ($hora = 8; $hora < 13; $hora++) {
    $horarios_disponiveis[] = sprintf('%02d:00', $hora);
    $horarios_disponiveis[] = sprintf('%02d:30', $hora);
}
// Adicionar 13:00
$horarios_disponiveis[] = '13:00';

// Gerar horários tarde (14:00 até 18:00)
for ($hora = 14; $hora <= 18; $hora++) {
    if ($hora < 18) {
        $horarios_disponiveis[] = sprintf('%02d:00', $hora);
        $horarios_disponiveis[] = sprintf('%02d:30', $hora);
    } else {
        $horarios_disponiveis[] = '18:00';
    }
}

// ==================== BUSCAR AGENDAMENTOS JÁ EXISTENTES ====================
$sql_agendamentos = "
    SELECT data 
    FROM utilizador_has_imoveis
    WHERE Agentes_ID_Agentes = ?
    AND DATE(data) = ?
    AND Status_de_visita != 'finalizado'
";

$stmt = $conn->prepare($sql_agendamentos);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'erro' => 'Erro na consulta']);
    exit;
}

$stmt->bind_param("is", $id_agente, $data_visita);
$stmt->execute();
$result = $stmt->get_result();

$horas_ocupadas = [];

while ($row = $result->fetch_assoc()) {
    $hora_agendada = date('H:i', strtotime($row['data']));
    $horas_ocupadas[] = $hora_agendada;
}
$stmt->close();

// ==================== FILTRAR HORÁRIOS DISPONÍVEIS ====================
$horarios_finais = array_filter($horarios_disponiveis, function ($hora) use ($horas_ocupadas) {
    return !in_array($hora, $horas_ocupadas);
});

// Remover índices para retornar array sequencial
$horarios_finais = array_values($horarios_finais);

// ==================== RETORNAR JSON ====================
header('Content-Type: application/json');
echo json_encode([
    'sucesso' => true,
    'horarios' => $horarios_finais,
    'total' => count($horarios_finais)
]);

$conn->close();
?>