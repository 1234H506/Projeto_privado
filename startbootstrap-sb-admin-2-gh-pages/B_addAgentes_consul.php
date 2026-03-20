<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha ao tentar conectar: " . $conn->connect_error);
}

// Captura dos dados do POST
$nome = $_POST["nome"];
$telemovel = $_POST["numero"];
$servicos = $_POST["servicos"];
$email = $_POST["email"];
$Sexo = $_POST["sexo"];

// Verifica se o agente já existe
$sql_check = "SELECT Email FROM agentes WHERE Email = '$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    ?>
  <script>
    alert('Esse agente já registrado!');
    window.location.href = 'A_addAgentes.php';
  </script>
  <?php
  exit;
}


// Tratamento da imagem (se enviada) - Se o ficheiro existir e não ocorrer nenhum erro 
if (isset($_FILES['inputImagem']) && $_FILES['inputImagem']['error'] === 0) {

    $nome_arquivo = $_FILES['inputImagem']['name'];


    // Extensão em minúsculas
    $imageFileType = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    // Gera nome único
    $novo_nome = "agent_" . date("YmdHis") . "_" . uniqid() . "." . $imageFileType;

    // Pasta de destino
    $target_dir = "img/agents/";
    

    $target_file = $target_dir . $novo_nome;

    $uploadOk = 1;

    // Valida se é imagem
    $check = getimagesize($_FILES['inputImagem']['tmp_name']);
    if ($check === false) {
      $uploadOk = 0;
      ?>
      <script>
      alert("O arquivo não é real.");
      window.location.href = 'B_addAgentes.php';
    </script>
    <?php
    exit;
      }

    // Valida tamanho (500KB)
    if ($_FILES["inputImagem"]["size"] > 500000){
      $uploadOk = 0;
      ?>
      <script>
      alert("O arquivo é maior que sugerido (500KB).");
      window.location.href = 'B_addAgentes.php';
    </script>
    <?php
    exit;
      } 

    // Valida formato
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "webp"])) {
      $uploadOk = 0;
       ?>
      <script>
      alert("O arquivo não tem o formato sugerido.");
      window.location.href = 'B_addAgentes.php';
    </script>
    <?php
    exit;
    }

    if ($uploadOk == 0) {
         ?>
      <script>
      alert("Erro nas validações da imagem.");
      window.location.href = 'B_addAgentes.php';
    </script>
    <?php
    exit;
    }

    
}

// Inserção no banco
$sql = "INSERT INTO agentes (Nome,NdeTelemovel,Servicos,Email,disponibilidades,Imagem,Sexo) VALUE ('$nome','$telemovel','$servicos', '$email','1','$novo_nome','$Sexo')";

//Se os dados for registrado
   if($conn->query($sql) === TRUE){
   if (move_uploaded_file($_FILES["inputImagem"]["tmp_name"], $target_file)) {
           ?>
      <script>
      alert("Os dados foram salvos com sucesso.");
      window.location.href = 'B_tablesAgentes.php';
    </script>
    <?php
    exit;
    }  

   
} else {
    echo "Erro no banco: " . $conn->error;
    header("Location: B_addAgentes.php");
    exit();
}

$conn->close();
?>


