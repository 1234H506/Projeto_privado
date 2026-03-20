<?php
// D_ajax_verificarDisponibilidade.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) { die("Erro: " . $conn->connect_error); }

// Função auxiliar para calcular duração baseada na tipologia
function calcularTempo($tipologia) {
    $minutos = 0;
    switch (strtoupper($tipologia)) {
        case 'T0':
        case 'T1': $minutos = 30; break;
        case 'T2':
        case 'T3': $minutos = 60; break;
        case 'T4': $minutos = 90; break;
        default:   $minutos = 120; // T5 ou superior
    }
    return $minutos + 30; // Soma o buffer de deslocamento/água
}

if (isset($_POST['id_agente'], $_POST['id_imovel'], $_POST['data_visita'])) {
    $id_agente = $_POST['id_agente'];
    $id_imovel = $_POST['id_imovel'];
    $data_visita = $_POST['data_visita'];

    // 1. Duração da NOVA VISITA (que o usuário quer marcar agora)
    $resTip = $conn->query("SELECT Tipologia FROM imoveis WHERE ID_Imoveis = '$id_imovel'");
    $nova_duracao = ($resTip->num_rows > 0) ? calcularTempo($resTip->fetch_assoc()['Tipologia']) : 60;

    // 2. Buscar visitas existentes + Tipologia dos imóveis dessas visitas
    // Precisamos da tipologia para saber quanto tempo durou a visita que já está no banco
    $sqlVisitas = "SELECT v.data, i.Tipologia 
               FROM utilizador_has_imoveis v
               INNER JOIN imoveis i ON v.Imoveis_ID_Imoveis = i.ID_Imoveis
               WHERE DATE(v.data) = '$data_visita' 
               AND (v.Agentes_ID_Agentes = '$id_agente' OR v.Imoveis_ID_Imoveis = '$id_imovel')";
    
    $result = $conn->query($sqlVisitas);
    $ocupados = [];

    while($row = $result->fetch_assoc()) {
        $ocupados[] = [
            'inicio' => $row['data'],
            'duracao' => calcularTempo($row['Tipologia'])
        ];
    }

    echo json_encode([
        'nova_duracao' => $nova_duracao,
        'ocupados' => $ocupados
    ]);
}