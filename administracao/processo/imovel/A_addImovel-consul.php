<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Falha ao tentar conectar: " . $conn->connect_error);
}


//Exibir campos preenchidos
if (isset($_POST["inputFreguesia"]) && !empty($_POST["inputFreguesia"])){
  $Freguesia = $_POST["inputFreguesia"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de freguesia válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();
}

if (isset($_POST["inputMorada"]) && !empty($_POST["inputMorada"])) {
  $Morada = $_POST["inputMorada"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição da morada válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();
}

if (isset($_POST["inputConcelho"]) && !empty($_POST["inputConcelho"])){
  $Concelho = $_POST["inputConcelho"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de concelho válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}

if (isset($_POST["inputDistrito"]) && !empty($_POST["inputDistrito"])){
  $Distrito = $_POST["inputDistrito"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de distrito válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}

if (isset($_POST["inputCodigo"]) && !empty($_POST["inputCodigo"])){
  $Codigo = $_POST["inputCodigo"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de código postal válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}

if (isset($_POST["inputArea"]) && !empty($_POST["inputArea"])){
  $Area = $_POST["inputArea"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de área válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}

if (isset($_POST["inputTipologia"]) && !empty($_POST["inputTipologia"])) {
  $Tipologia = $_POST["inputTipologia"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de tipologia válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}

if (isset($_POST["inputGaragem"])) {
  $Garagem = $_POST["inputGaragem"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de garagem válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}

if (isset($_POST["inputEntradas"]) && !empty($_POST["inputEntradas"])){
  $Entradas = $_POST["inputEntrada"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de entrada válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}


if (isset($_POST["inputTipo"]) && !empty($_POST["inputTipo"])){
  $Tipo = $_POST["inputTipo"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de tipo de imóvel válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}


if (isset($_POST["inputEstado"]) && !empty($_POST["inputEstado"])){
  $Estado = $_POST["inputEstado"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de estado do imóvel válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}


if (isset($_POST["inputPreco"]) && !empty($_POST["inputPreco"])){
  $Preco = $_POST["inputPreco"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de preço do imóvel válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}


if (isset($_POST["inputData"]) && !empty($_POST["inputData"])){
  $Data = $_POST["inputData"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de data de registro válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}



if (isset($_POST["inputComentario"]) && !empty($_POST["inputComentario"])){
  $Comentario = $_POST["inputComentario"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de comentário válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}


if (isset($_POST["sotao"])) {
  $Sotao = $_POST["sotao"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de sotão válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}


if (isset($_POST["elevador"])) {
  $Elevador = $_POST["elevador"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de elevador válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}

if (isset($_POST["inputAgente"]) && !empty($_POST["inputAgente"])){
  $Agente = $_POST["inputAgente"];
}else{
  ?>
    <script>
        alert('Não obedece à requisição de agente válido!');
        window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit();  
}


// 2. VERIFICAÇÃO INICIAL: O imóvel já existe?
$sql_check = "SELECT Morada FROM imoveis WHERE Morada = '$Morada'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
  ?>
  <script>
    alert('Este imóvel já se encontra registado no sistema.');
    window.location.href = '../../form/imovel/A_addImovel.php';
  </script>
  <?php
  exit;
}

//  SE O IMÓVEL NÃO EXISTE, TRATAMOS A IMAGEM
if (isset($_FILES['inputImagens']) && $_FILES['inputImagens']['error'] === 0) {


  // Faça isso 
  $nome_arquivos = $_FILES['inputImagens']['name'];

  // Essa linha pega a extensão do arquivo e a transforma em letras minúsculas.
  $imageFileType = strtolower(pathinfo($nome_arquivos, PATHINFO_EXTENSION));


  // GERA O NOME ÚNICO (Sua ideia aplicada)
  $novo_nome = "capa_" . date("YmdHis") . "_" . uniqid() . "." . $imageFileType;

  // Local onde será adicionado 
  $target_dir = "../../img/principal/";


  // Concatena a variável para obter um caminho
  $target_file = $target_dir . $novo_nome;


  $uploadOk = 1;

  // Validação de Imagem Real
  $check = getimagesize($_FILES['inputImagens']['tmp_name']);
  if ($check === false) {
    $uploadOk = 0;
    ?>
    <script>
      alert("O arquivo não é real.");
      window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit;
  }

  // Validação de Tamanho (500KB) - Removido o [$i] que dava erro
  if ($_FILES["inputImagens"]["size"] > 500000) {
    $uploadOk = 0;
    ?>
    <script>
      alert("O arquivo é maior que sugerido (500KB).");
      window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit;
  }

  // Validação de Formato
  if (!in_array($imageFileType, ["jpg", "jpeg", "png", "webp"])){
    $uploadOk = 0;
    ?>
    <script>
      alert("O arquivo não tem o formato sugerido.");
      window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit;

  }
  if ($uploadOk == 0) {
    ?>
    <script>
      alert('Erro nas validações da imagem.');
      window.location.href = '../../form/imovel/A_addImovel.php';
    </script>
    <?php
    exit;
  }

  //  SE A IMAGEM ESTÁ OK, SALVAMOS O IMÓVEL NO BANCO
$sql_insert = "INSERT INTO imoveis(
  Freguesia,
  Morada,
  concelho,
  Distrito,
  Codigopostal,
  Areautil,
  Tipologia,
  Ndeentradas,
  Capacidadedegaragem,
  Elevador,
  Tipodeimovel,
  Estado,
  Preco,
  Dataderegistro,
  Imagens,
  Sotao,
  Comentariosderaridade,
  Disponibilidade,
  Agentes_ID_Agentes

) VALUES (
    '$Freguesia',
    '$Morada',
    '$Concelho',
    '$Distrito',
    '$Codigo',
    '$Area',
    '$Tipologia',
    '$Entradas',
    '$Garagem',
    '$Elevador',
    '$Tipo',
    '$Estado',
    '$Preco',
    '$Data',
    '$novo_nome',
    '$Sotao',
    '$Comentario',
    '1',
    '$Agente'
)";

  if ($conn->query($sql_insert) === TRUE) {
    $id_imovel = $conn->insert_id;

    // SÓ AGORA movemos o arquivo para a pasta (Evita arquivos órfãos)
   if (move_uploaded_file($_FILES["inputImagens"]["tmp_name"], $target_file)) {
      $_SESSION['id_imovel'] = $id_imovel;
      $_SESSION['morada'] = $Morada;
      ?>
      <script>
        alert("Os dados foram salvos com sucesso.");
        window.location.href = '../../templates/imoveis/A_tablesCasas.php';
      </script>
      <?php
      exit;
    } else {
      ?>
      <script>
        alert("Erro ao mover arquivo.");
        window.location.href = '../../form/imovel/A_addImovel.php';
      </script>
      <?php
      exit;
    }
  } else {
    echo "Erro no banco: " . $conn->error;
  }
}
$conn->close();
?>