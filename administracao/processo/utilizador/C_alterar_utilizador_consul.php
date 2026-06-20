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
if(isset($_POST['id']) and !empty($_POST['id'])){
  $id = $_POST['id'];
}else{
  ?>
    <script>
        alert('Não obedece à requisição para um id válido!');
        window.location.href = '../../form/utilizador/C_Alterar_Utilizador.php';
    </script>
    <?php
    exit();
}

if(isset($_POST['nome']) and !empty($_POST['nome'])){
  $nome = $_POST["nome"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição para um nome válido!');
        window.location.href = '../autenticacao/cadastro.php';
    </script>
    <?php
    exit();
}


if(isset($_POST['numero']) && !empty($_POST['numero'])){
    $telemovel = $_POST['numero'];
}else{
    ?>
    <script>
        alert('Número de telemóvel inválido!');
        window.location.href = '../../form/utilizador/C_Alterar_Utilizador.php';
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
        window.location.href = '../../form/utilizador/C_Alterar_Utilizador.php';
    </script>
    <?php
    exit();
}

if(isset($_POST['sexo'])){
    $sexo_input = $_POST['sexo'];
}
else{
    ?>
    <script>
        alert('Sexo inválido!');
        window.location.href = '../../form/utilizador/C_Alterar_Utilizador.php';
    </script>
    <?php
    exit();
}


if(isset($_POST['Admin'])){
    $admin = $_POST['Admin'];
}else{
    ?>
    <script>
        alert('Perfil de administrador inválido!');
        window.location.href = '../../form/utilizador/C_Alterar_Utilizador.php';
    </script>
    <?php
    exit();
}


$sql_verificacao = "SELECT * FROM utilizador WHERE ID_Utilizador = $id";
$resultado = $conn->query($sql_verificacao);

if($resultado->num_rows === 1){
    $utilizador = $resultado->fetch_assoc();
    $nome_db = $utilizador['Nome'];
    $email_db = $utilizador['Email'];
    $telemovel_db = $utilizador['nr_telemovel'];
    $sexo_db = $utilizador['Sexo'];
    $imagem_db = $utilizador['Imagem'];

}


$tem_imagem_nova = false;
if (isset($_FILES['inputImagem']['name']) && !empty($_FILES['inputImagem']['name'])) {
    $imagem = $_FILES['inputImagem']['name'];
    $tem_imagem_nova = true;
}

if ($tem_imagem_nova){
   if (isset($_FILES['inputImagem']) && $_FILES['inputImagem']['error'] === 0) {

     $nome_arquivo = $_FILES['inputImagem']['name'];


    // Extensão em minúsculas
    $imageFileType = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    // Gera nome único
    $novo_nome = "utilizador_" . date("YmdHis") . "_" . uniqid() . "." . $imageFileType;

    // Pasta de destino
    $target_dir = "../../img/utilizador/";
    

    $target_file = $target_dir . $novo_nome;

    $uploadOk = 1;

    // Valida se é imagem
    $check = getimagesize($_FILES['inputImagem']['tmp_name']);
    if ($check === false) {
      $uploadOk = 0;
      ?>
      <script>
      alert("O arquivo não é real.");
      window.location.href = '../../form/utilizador/C_Alterar_Utilizador.php';
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
      window.location.href = '../../form/utilizador/C_Alterar_Utilizador.php';
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
      window.location.href = '../../form/utilizador/C_Alterar_Utilizador.php';
    </script>
    <?php
    exit;
    }

    if ($uploadOk == 0) {
         ?>
      <script>
      alert("Erro nas validações da imagem.");
      window.location.href = '../../form/utilizador/C_Alterar_Utilizador.php';
    </script>
    <?php
    exit;
    }
}

// Atualizar os valores alterados - Se existir imagem nova 

    $sql = "UPDATE utilizador SET Nome = '$nome', nr_telemovel = '$telemovel',Email = '$email' , Sexo = '$sexo' , administrador = '$admin' , Imagem = '$novo_nome' WHERE ID_Utilizador = '$id' ";
     //Se os dados for registrado
    if($conn->query($sql) === TRUE){
     if (move_uploaded_file($_FILES["inputImagem"]["tmp_name"], $target_file)) {
           ?>
      <script>
      alert("Os dados foram salvos com sucesso.");
      window.location.href = '../../templates/utilizador/C_tablesUtilizador.php';
    </script>
    <?php
    exit;
    }  
    }  
}

// Verifica se o usuário mudou o sexo para mudar o icon
elseif ($sexo_db !== $sexo_input){
  if($sexo_input == 0){
    $imagem_db = "avatar-masculino.png";
    $sql_update = "UPDATE utilizador SET Nome = '$nome', nr_telemovel = '$telemovel',Email = '$email' , Sexo = '$sexo_input' , administrador = '$admin', Imagem = '$imagem_db' WHERE ID_Utilizador = '$id' ";
    $conn->query($sql_update);
      ?>
      <script>
       window.location.href = '../../templates/utilizador/C_tablesUtilizador.php';
     </script>
     <?php
      exit;

  }else{
    $imagem_db = "avatar-feminino.png";
    $sql_update = "UPDATE utilizador SET Nome = '$nome', nr_telemovel = '$telemovel',Email = '$email' , Sexo = '$sexo_input' , administrador = '$admin', Imagem = '$imagem_db' WHERE ID_Utilizador = '$id' ";
    $conn->query($sql_update);
      ?>
      <script>
       window.location.href = '../../templates/utilizador/C_tablesUtilizador.php';
     </script>
     <?php
      exit;
  }
}

// Salva os dados sem a foto 
else{
  $sql = "UPDATE utilizador SET Nome = '$nome', nr_telemovel = '$telemovel',Email = '$email' , Sexo = '$sexo' , administrador = '$admin'  WHERE ID_Utilizador = '$id' ";
      $conn->query($sql);
      ?>
      <script>
       window.location.href = '../../templates/utilizador/C_tablesUtilizador.php';
     </script>
     <?php
     exit;
}
?>