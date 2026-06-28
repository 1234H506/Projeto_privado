<?php
// forms/A_processar_agendamento.php

session_start();

// Verificar autenticação
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    http_response_code(401);
    echo json_encode(['sucesso' => false, 'erro' => 'Você precisa estar autenticado']);
    exit;
}
include("../config.php/base.php");
include("../reutilizaveis/conexao.php");

date_default_timezone_set('Europe/Lisbon');

// ==================== VALIDAÇÃO DE DADOS ====================

$erros = [];

// Pegar dados do formulário
$Id_utilizador = $_SESSION["id"];
$idimovel = $_POST['idimovel'] ?? null;
$id_agente = $_POST['id_agente'] ?? null;
$dataDeRegistro = $_POST['dataDeRegistro'] ?? null;
$horaDeRegistro = $_POST['horaDeRegistro'] ?? null;

// Validar ID do imóvel
if (!$idimovel || !is_numeric($idimovel)) {
    $erros[] = "Imóvel inválido";
}

// Validar ID do agente
if (!$id_agente || !is_numeric($id_agente)) {
    $erros[] = "Agente inválido";
}

// Validar data
if (!$dataDeRegistro || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataDeRegistro)) {
    $erros[] = "Data inválida";
} else {
    $hoje = new DateTime('now', new DateTimeZone('Europe/Lisbon'));
    $hoje->setTime(0, 0, 0); // ← normaliza para meia-noite
    $data_selecionada = new DateTime($dataDeRegistro, new DateTimeZone('Europe/Lisbon'));
    $data_selecionada->setTime(0, 0, 0); // ← garante comparação só de datas

    if ($data_selecionada <= $hoje) {
        $erros[] = "Você só pode agendar para datas futuras (a partir de amanhã)";
    }
}

// Validar hora
if (!$horaDeRegistro || !preg_match('/^\d{2}:\d{2}$/', $horaDeRegistro)) {
    $erros[] = "Hora inválida";
} else {
    $partes_hora = explode(':', $horaDeRegistro);
    $hora_int = intval($partes_hora[0]);

    $hora_valida = false;
    if (($hora_int >= 8 && $hora_int < 13) || ($hora_int >= 14 && $hora_int < 18)) {
        $hora_valida = true;
    }
    if ($horaDeRegistro == '13:00' || $horaDeRegistro == '18:00') {
        $hora_valida = true;
    }

    if (!$hora_valida) {
        $erros[] = "Horário fora do funcionamento (8h-13h e 14h-18h)";
    }
}

// Se houver erros
if (!empty($erros)) {
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'erro' => implode(', ', $erros)]);
    exit;
}

// ==================== VERIFICAR SE HORÁRIO JÁ ESTÁ OCUPADO ====================

$sql_verifica = "
    SELECT COUNT(*) as total
    FROM utilizador_has_imoveis
    WHERE Agentes_ID_Agentes = ?
    AND DATE(data) = ?
    AND TIME(data) = ?
    AND Status_de_visita != 'finalizado'
";

$stmt = $conn->prepare($sql_verifica);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'erro' => 'Erro ao verificar disponibilidade']);
    exit;
}

$stmt->bind_param("iss", $id_agente, $dataDeRegistro, $horaDeRegistro);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['total'] > 0) {
    http_response_code(409);
    echo json_encode(['sucesso' => false, 'erro' => 'Este horário já foi agendado para este agente. Escolha outro horário.']);
    exit;
}
$stmt->close();

// ==================== LÓGICA DO STATUS AUTOMÁTICO ====================

function calcularTempo($tipologia)
{
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
    return $minutos + 30;
}

// Buscar tipologia do imóvel
$stmt = $conn->prepare("SELECT Tipologia FROM imoveis WHERE ID_Imoveis = ?");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'erro' => 'Erro ao buscar tipologia']);
    exit;
}

$stmt->bind_param("i", $idimovel);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$tipologia = $row['Tipologia'] ?? 'T2';
$stmt->close();

// Criar datetime completo
$data_final_string = $dataDeRegistro . " " . $horaDeRegistro . ":00";

// Calcular tempos
$inicio = strtotime($data_final_string);
$duracao_minutos = calcularTempo($tipologia);
$fim = $inicio + ($duracao_minutos * 60);
$agora = time();

// Determinar status
if ($agora < $inicio) {
    $status_final = "em_breve";
} elseif ($agora >= $inicio && $agora <= $fim) {
    $status_final = "em_andamento";
} else {
    $status_final = "finalizado";
}

// ==================== INSERIR AGENDAMENTO NO BANCO ====================

$comentarios = "";
$resultado = "pendente";

$sql_insere = "
    INSERT INTO utilizador_has_imoveis 
    (Utilizador_ID_Utilizador, Imoveis_ID_Imoveis, Agentes_ID_Agentes, data, comentarios, Status_de_visita, resultado)
    VALUES (?, ?, ?, ?, ?, ?, ?)
";

$stmt = $conn->prepare($sql_insere);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'erro' => 'Erro ao preparar inserção']);
    exit;
}

$stmt->bind_param(
    "iiissss",
    $Id_utilizador,
    $idimovel,
    $id_agente,
    $data_final_string,
    $comentarios,
    $status_final,
    $resultado
);

if ($stmt->execute()) {
    $stmt->close();

    // Sucesso!
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(200);
    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Agendamento realizado com sucesso! Você receberá uma confirmação em breve.',
        'data' => $dataDeRegistro,
        'hora' => $horaDeRegistro
    ]);
    exit;
} else {
    // Erro ao inserir
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'erro' => 'Erro ao realizar agendamento']);
    exit;
}
?>