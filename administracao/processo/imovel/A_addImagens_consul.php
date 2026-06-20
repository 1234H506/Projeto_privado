<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Falha ao tentar conectar: " . $conn->connect_error);
}

// id do imovel
$id = $_POST['id_imovel'];

$i = 0;

// Usamos essa variável para contar quantos valor temos no array
$total_arquivos = count($_FILES['Imagens_galeria']['name']);

while ($i < $total_arquivos) {

  // Faça isso 
  $nome_arquivos = $_FILES['Imagens_galeria']['name'][$i];

  // Essa linha pega a extensão do arquivo e a transforma em letras minúsculas.
  $imageFileType = strtolower(pathinfo($nome_arquivos, PATHINFO_EXTENSION));


  // GERA O NOME ÚNICO (Sua ideia aplicada)
  $novo_nome = "imovel_" . $id . "_" . date("YmdHis") . "_" . uniqid() . "." . $imageFileType;

  // Local onde será adicionado 
  $target_dir = "../../img/galeria/";

  
  // Concatena a variável para obter um caminho
  $target_file = $target_dir . $novo_nome;

  // Variável para vê se continua o não
  $uploadOk = 1;
 

  // check se a imagem é verdade ou falsa
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["Imagens_galeria"]["tmp_name"][$i]);
    if ($check !== false) {
      // "mime" diz qual é a extensão do arquivo
      "Arquivo é uma imagem  - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
      ?>
      <script>
        alert("Arquivo não é uma imagem");
        window.location.href = '../../templates/imoveis/A_galeria_imagem.php';
      </script>
      <?php
      exit;
    }
  }

  
  // Verifica o tamanho do arquivo
  if ($_FILES["Imagens_galeria"]["size"][$i] > 800000) {
    $uploadOk = 0;
    ?>
    <script>
      alert("Desculpa , o arquivo é muito grande");
      window.location.href = '../../templates/imoveis/A_galeria_imagem.php';
    </script>
    <?php
    exit;
    //Aviso no input
  }

  // Formatos permitdos
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "webp" && $imageFileType != "jpeg") {
    $uploadOk = 0;
    ?>
    <script>
      alert("Desculpe, apenas aceitamos imagens com formato PNG , JPG , JPEG e WEBP");
      window.location.href = '../../templates/imoveis/A_galeria_imagem.php';
    </script>
    <?php
    exit;
  }

  // Verifica se a variável uploadOk é 0
  if ($uploadOk == 0) {

    ?>
    <script>
      alert("Desculpa , os arquivos não foi salvo.");
      window.location.href = '../../templates/imoveis/A_galeria_imagem.php';
    </script>
    <?php
    exit;

    // Se estiver igual 1
  } else {
    if (move_uploaded_file($_FILES["Imagens_galeria"]["tmp_name"][$i], $target_file)) {

      $sql = "INSERT INTO galeria (Fotos , Imoveis_ID_Imoveis) VALUES ('$novo_nome','$id') ";

      if ($conn->query($sql)) {
        //Conferido as imagens 
      } else {
        ?>
      <script>
        alert("Erro ao salvar no banco.");
        window.location.href = '../../templates/imoveis/A_galeria_imagem.php';
      </script>
      <?php
      exit;

      }
      "O arquivo " . htmlspecialchars(basename($_FILES["Imagens_galeria"]["name"][$i])) . " foi feito upload.";
    } else {
      ?>
      <script>
        alert("Desculpe, ocorreu um erro ao enviar o seu ficheiro.");
        window.location.href = '../../templates/imoveis/A_galeria_imagem.php';
      </script>
      <?php
      exit;

    }

  }
  $i++;
}

?>
<script>
    alert("Todas as imagens foram enviadas com sucesso");
    window.location.href = '../../templates/imoveis/A_galeria_imagem.php'; 
</script>
<?php
exit;

?>