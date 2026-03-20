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



date_default_timezone_set('Europe/Lisbon');

// 1. Receber os dados do formulário
$id_registro = $_POST['id'];
$data_form   = $_POST['dataDeRegistro']; // Ex: 2026-02-17
$hora_form   = $_POST['horaDeRegistro']; // Ex: 14:30
$comentario  = $_POST['comentarios'];
$id_imovel   = $_POST['NomeDoImovel'];

// 2. Criar o DATETIME completo para o banco
$data_final_string = $data_form . " " . $hora_form . ":00";

// 3. Buscar a tipologia do imóvel para calcular o tempo
// Precisamos saber a tipologia para saber quando a visita termina
$sql_tipo = "SELECT tipologia FROM imoveis WHERE ID_Imoveis = '$id_imovel'";
$res_tipo = mysqli_query($conn, $sql_tipo);
$row_tipo = mysqli_fetch_assoc($res_tipo);
$tipologia = $row_tipo['tipologia'];

// 4. A sua função de cálculo
function calcularTempo($tipologia) {
    $minutos = 0;
    switch (strtoupper($tipologia)) {
        case 'T0':
        case 'T1': $minutos = 30; break;
        case 'T2':
        case 'T3': $minutos = 60; break;
        case 'T4': $minutos = 90; break;
        default:   $minutos = 120;
    }
    return $minutos + 30; 
}

// 5. LÓGICA DO STATUS AUTOMÁTICO
$inicio = strtotime($data_final_string);
$duracao_minutos = calcularTempo($tipologia);
$fim = $inicio + ($duracao_minutos * 60);
$agora = time();

if ($agora < $inicio) {
    $status_final = "Em breve";
} elseif ($agora >= $inicio && $agora <= $fim) {
    $status_final = "Em andamento";
} else {
    if (empty($comentario) || trim($comentario) == "") {
        $status_final = "Finalizada, mas falta o comentário";
    } else {
        $status_final = "Finalizada";
    }
}

// 6. UPDATE NO BANCO DE DADOS
$sql_update = "UPDATE utilizador_has_imoveis SET 
               data = '$data_final_string', 
               comentarios = '$comentario', 
               Status_de_visita = '$status_final', 
               Imoveis_ID_Imoveis = '$id_imovel'
               WHERE id_registro = '$id_registro'";

$conn->query($sql_update);
header("Location: D_tablesVisitas.php");
exit;
?>

