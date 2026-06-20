<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

// cria a conexão com o BD
$conn = new mysqli($servername, $username, $password, $dbname);
// Check conexão
if ($conn->connect_error) {
    die("Falha ao tentar conectar" . $conn->connect_error);
}

// 1. Pega o id vía POST
// Verificamos se recebemos um post com o id do agente a ser deletado
$id = $_POST['id'];


// 2. Usa o ID para pegar o nome da imagem
$sql_imagem = "SELECT Imagem FROM agentes WHERE ID_Agentes = $id AND disponibilidades = 0;";
$result = mysqli_query($conn,$sql_imagem);

if (mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result); 
    $imagem = $row['Imagem'];   
}


// 3.Caminho da (Imagem + Nome) sabemos aonde realmente está 
$caminho = "../../img/agents/".$imagem;


// 4. Elimina o arquivo da imagem se existir 
if (file_exists($caminho)){
    unlink($caminho);
}else{
    ?>
    <script>
      alert('Erro ao tentar achar o arquivo.');
      window.location.href = '../../templates/agentes/B_tablesAgentesArquivados.php';
    </script>
    <?php
    exit;
}


// 5. Faz o delete no banco de dados agora com id 

 $sql ="DELETE FROM agentes WHERE ID_Agentes = '$id'";
 $conn->query($sql);

//  6. Redireciona para página desejada

 header("Location: ../../templates/agentes/B_tablesAgentesArquivados.php");
// 7. Encerra o conexão com banco de dados 
 exit;
?>