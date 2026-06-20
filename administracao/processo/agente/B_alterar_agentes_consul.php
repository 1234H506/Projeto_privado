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

// Recuperar todos os valores no metodo post 
if(isset($_POST['id']) && !empty($_POST['id'])){
  $id = $_POST['id'];
}else{
  ?>
    <script>
        alert('O id não foi identificado no nosso banco de dados!');
        window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit();
}
if(isset($_POST['nome']) && !empty($_POST['nome'])){
  $nome = $_POST["nome"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição para um nome válido!');
        window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit();
}
if(isset($_POST['numero']) && !empty($_POST['numero'])){
  $telemovel = $_POST['numero'];
}else{
  ?>
    <script>
        alert('Número de telemóvel válido!');
        window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit();
}
if(isset($_POST['servicos']) && !empty($_POST['servicos'])){
  $servicos = $_POST['servicos'];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de serviço válido!');
        window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit();
}
if(isset($_POST['email']) && !empty($_POST['email'])){
  $email = $_POST['email'];
}else{
  ?>
    <script>
        alert('Email inválido!');
        window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit();
}
if(isset($_POST['sexo'])){
  $sexo = $_POST['sexo'];
}else{
  ?>
    <script>
        alert('Sexo inválido!');
        window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit();
}
if(isset($_FILES['inputImagem']['name'])){
  $imagem = $_FILES['inputImagem']['name'];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de imagem válido!!');
        window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit();
}

if (isset($_FILES['inputImagem']) && $_FILES['inputImagem']['error'] === 0) {

    $nome_arquivo = $_FILES['inputImagem']['name'];


    // Extensão em minúsculas
    $imageFileType = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    // Gera nome único
    $novo_nome = "agent_" . date("YmdHis") . "_" . uniqid() . "." . $imageFileType;

    // Pasta de destino
    $target_dir = "../../img/agents/";
    

    $target_file = $target_dir . $novo_nome;

    $uploadOk = 1;

    // Valida se é imagem
    $check = getimagesize($_FILES['inputImagem']['tmp_name']);
    if ($check === false) {
      $uploadOk = 0;
      ?>
      <script>
      alert("O arquivo não é real.");
      window.location.href = '../../templates/agentes/B_tablesAgentes.php';
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
      window.location.href = '../../templates/agentes/B_tablesAgentes.php';
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
      window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit;
    }

    if ($uploadOk == 0) {
         ?>
      <script>
      alert("Erro nas validações da imagem.");
      window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit;
    }

    
}


if (isset($novo_nome)){
// Inserção no banco
$sql = "UPDATE agentes SET nome = '$nome', NdeTelemovel = '$telemovel',Servicos = '$servicos',Email = '$email', Imagem = '$novo_nome',  Sexo = '$sexo' WHERE ID_Agentes = '$id' ";

//Se os dados for registrado
   if($conn->query($sql) === TRUE){
   if (move_uploaded_file($_FILES["inputImagem"]["tmp_name"], $target_file)) {
           ?>
      <script>
      alert("Os dados foram salvos com sucesso.");
      window.location.href = '../../templates/agentes/B_tablesAgentes.php';
    </script>
    <?php
    exit;
    }  
}
   
}else{
    // Atualizar os valores menos a coluna imagem
$sql = "UPDATE agentes SET nome = '$nome', NdeTelemovel = '$telemovel',Servicos = '$servicos',Email = '$email', Sexo = '$sexo' WHERE ID_Agentes = '$id' ";
$conn->query($sql);
// redireciona
header("Location: ../../templates/agentes/B_tablesAgentes.php");
// Encerra o banco de dados
exit;
}
?>