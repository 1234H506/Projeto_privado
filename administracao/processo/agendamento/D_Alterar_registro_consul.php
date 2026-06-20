<?php
include("../../verificacaoDeLogin.php");


date_default_timezone_set('Europe/Lisbon');

// ==================== VALIDAÇÃO DE DADOS ====================

$erros = [];

// Validar ID
$id_registro = $_POST['id'] ?? null;
if (!$id_registro || !is_numeric($id_registro)) {
    $erros[] = "ID de registro inválido";
}

// Validar outros campos obrigatórios
$nomeDoVisitante = $_POST['nomeDoVisitante'] ?? null;
$NomeDoAgente = $_POST['NomeDoAgente'] ?? null;
$NomeDoImovel = $_POST['NomeDoImovel'] ?? null;
$dataDeRegistro = $_POST['dataDeRegistro'] ?? null;
$horaDeRegistro = $_POST['horaDeRegistro'] ?? null;
$comentarios = $_POST['comentarios'] ?? '';
$resultado = $_POST['input_resultado'] ?? 'pendente';

if (!$nomeDoVisitante || !is_numeric($nomeDoVisitante)) {
    $erros[] = "Visitante inválido";
}
if (!$NomeDoAgente || !is_numeric($NomeDoAgente)) {
    $erros[] = "Agente inválido";
}
if (!$NomeDoImovel || !is_numeric($NomeDoImovel)) {
    $erros[] = "Imóvel inválido";
}
if (!$dataDeRegistro || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataDeRegistro)) {
    $erros[] = "Data inválida";
}
if (!$horaDeRegistro || !preg_match('/^\d{2}:\d{2}$/', $horaDeRegistro)) {
    $erros[] = "Hora inválida";
}
if (!in_array($resultado, ['pendente', 'vendido', 'nao_vendido'])) {
    $erros[] = "Resultado inválido";
}

// Se houver erros, retornar com mensagem
if (!empty($erros)) {
    $_SESSION['erro'] = implode(', ', $erros);
    header("Location: D_Alterar_registro.php?id=$id_registro");
    exit;
}

// ==================== LÓGICA DO STATUS AUTOMÁTICO ====================

// Função para calcular tempo baseado na tipologia
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

// Buscar tipologia do imóvel
$stmt = $conn->prepare("SELECT Tipologia FROM imoveis WHERE ID_Imoveis = ?");
$stmt->bind_param("i", $NomeDoImovel);
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


$stmt = $conn->prepare("UPDATE utilizador_has_imoveis 
                        SET Utilizador_ID_Utilizador = ?,
                            Imoveis_ID_Imoveis = ?,
                            Agentes_ID_Agentes = ?,
                            data = ?,
                            comentarios = ?,
                            Status_de_visita = ?,
                            resultado = ?
                        WHERE id_registro = ?");

if (!$stmt) {
    $_SESSION['erro'] = "Erro na preparação da consulta: " . $conn->error;
    header("Location: D_Alterar_registro.php?id=$id_registro");
    exit;
}

$stmt->bind_param(
    "iiiisssi",
    $nomeDoVisitante,
    $NomeDoImovel,
    $NomeDoAgente,
    $data_final_string,
    $comentarios,
    $status_final,
    $resultado,
    $id_registro
);

if ($stmt->execute()) {
    // Sucesso - definir mensagem de sucesso e redirecionar
    $_SESSION['sucesso'] = "Registro alterado com sucesso!";
    header("Location: ../../templates/agendamento/D_tablesVisitas.php");
    exit;
} else {
    // Erro ao executar
    $_SESSION['erro'] = "Erro ao alterar registro: " . $stmt->error;
    header("Location: D_Alterar_registro.php?id=$id_registro");
    exit;
}

?>