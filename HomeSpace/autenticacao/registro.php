<?php

// variável de conexão ao banco de dados 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";

//  Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão , se a conexão falha aparece uma mensagem 
if ($conn->connect_error) {
    die("Falha ao tentar conectar" . $conn->connect_error);
}

// Exibe a variável que foi chamada para verificamos se está tudo correto com o método
// input nome
if (isset($_POST["Nome_Usuario"]) and !empty($_POST["Nome_Usuario"])) {
    $Nome = $_POST["Nome_Usuario"];
} else {
    ?>
    <script>
        alert('Não obedece à requisição para um nome válido!');
        window.location.href = '../autenticacao/cadastro.php';
    </script>
    <?php
    exit();
}
// input email
if (isset($_POST["Email_Usuario"]) and !empty($_POST["Email_Usuario"])) {
    $Email = $_POST["Email_Usuario"];
}else{
    ?>
    <script>
        alert('Não obedece à requisição para um email válido!');
        window.location.href = '../autenticacao/cadastro.php';
    </script>
    <?php
    exit();
}
// input telemóvel
if (isset($_POST["Telemovel_Usuario"]) and !empty($_POST["Telemovel_Usuario"])) {
    $Telemovel = $_POST["Telemovel_Usuario"];
}else{
    ?>
    <script>
        alert('Não obedece à requisição para um número de telemóvel válido!');
        window.location.href = '../autenticacao/cadastro.php';
    </script>
    <?php
    exit();
}
// input sexo
if (isset($_POST["Sexo_Usuario"]) and $_POST["Sexo_Usuario"] !== "") {
    $Sexo = $_POST["Sexo_Usuario"];
}else{
    ?>
    <script>
        alert('Não obedece à requisição para um sexo válido!');
        window.location.href = '../autenticacao/cadastro.php';
    </script>
    <?php
    exit();
}

// input senha
if (isset($_POST["Senha_Usuario"]) and !empty($_POST["Senha_Usuario"])) {
    $Senha = $_POST["Senha_Usuario"];
    $Senha_encrip = md5($Senha); // Usamos o "md5" para encripita a senha no banco de dados 
}else{
     ?>
    <script>
        alert('Não obedece à requisição para uma senha válida!');
        window.location.href = '../autenticacao/cadastro.php';
    </script>
    <?php
    exit();
}
// input repita senha
if (isset($_POST["Repita_Senha_Usuario"]) and !empty($_POST["Repita_Senha_Usuario"])) {
    $Repita = $_POST["Repita_Senha_Usuario"];    
}else{
     ?>
    <script>
        alert('Não obedece à requisição para uma senha de confirmação válida!');
        window.location.href = '../autenticacao/cadastro.php';
    </script>
    <?php
    exit();
}

// Verifica senha e repita senha se coincidem 
if ($Senha !== $Repita) {
    ?> 
    <script>
        alert('A senhas não colidem !');
        window.location.href = '../autenticacao/cadastro.php';
    </script>;
    <?php
    exit();

} else {

    // Verifica se existe utilizador com o mesmo email
    $sql = "SELECT Email FROM utilizador where Email ='$Email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        ?> 
        <script>
            alert('Usuário já existe!');
            window.location.href = '../autenticacao/cadastro.php';
        </script>
        <?php
        exit();
    } else {
        // Se os dados for registrado e for do sexo feminino

        if ($Sexo == 0) {

            $imagem = 'avatar-masculino.png';
            // Se não existe, Inserir os dados das variável no banco de dados "Utilizador"
            $sql = "INSERT INTO UTILIZADOR (nome, nr_telemovel, password,email,Sexo,Imagem)     
        VALUES ('$Nome', '$Telemovel', '$Senha_encrip','$Email','$Sexo','$imagem')";
            $conn->query($sql); // coloque isto para executar a query
            header("Location:../pagina/index.php");
            exit();
        }
        // Se for do sexo masculino
        if ($Sexo == 1) {
            $imagem = 'avatar-feminino.png';
            // Se não existe, Inserir os dados das variável no banco de dados "Utilizador"
            $sql = "INSERT INTO UTILIZADOR (nome, nr_telemovel, password,email,Sexo,Imagem)     
        VALUES ('$Nome', '$Telemovel', '$Senha_encrip','$Email','$Sexo','$imagem')";          // imagem
            $conn->query($sql); // coloque isto para executar a query
            header("Location:index.php");
            exit();

        }


        // Se os dados não for registrado
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

    }
}
?>

