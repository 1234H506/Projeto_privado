<?php

// variável de conexão ao banco de dados 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homespace";


// Exibe a variável que foi chamada para verificamos se está tudo correto com o método
// input nome
if (isset($_POST["Nome_Usuario"])) {
    $Nome = $_POST["Nome_Usuario"];
    print ("Nome do Usuário : $Nome");
    print ("<br>");
}
// input email
if (isset($_POST["Email_Usuario"])) {
    $Email = $_POST["Email_Usuario"];
    print ("Email do usuário : $Email");
    print ("<br>");
}
// input telemóvel
if (isset($_POST["Telemovel_Usuario"])) {
    $Telemovel = $_POST["Telemovel_Usuario"];
    print ("Número de telemóvel : $Telemovel");
    print ("<br>");
}
// input sexo
if (isset($_POST["Sexo_Usuario"])) {
    $Sexo = $_POST["Sexo_Usuario"];
    print ("Sexo do usuário : $Sexo");
    print ("<br>");
}

// input senha
if (isset($_POST["Senha_Usuario"])) {
    $Senha = $_POST["Senha_Usuario"];

    $Senha_encrip = md5($Senha); // Usamos o "md5" para encripita a senha no banco de dados 
    print ("Senha : $Senha_encrip");
    print ("<br>");
}
// input repita senha
if (isset($_POST["Repita_Senha_Usuario"])) {
    $Repita = $_POST["Repita_Senha_Usuario"];
    print ("Senha sem emcrip : $Repita");
    print ("<br>");
}




// Verifica senha e repita senha se coincidem 
if ($Senha !== $Repita) {
    ?> "
    <script>
        alert('A senhas não colidem !');
        window.location.href = 'cadastro.php';
    </script>";
    <?php
    exit();

} else {

    //  Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão , se a conexão falha aparece uma mensagem 
    if ($conn->connect_error) {
        die("Falha ao tentar conectar" . $conn->connect_error);
    }

    // Verifica se existe utilizador com o mesmo email
    $sql = "SELECT Email FROM utilizador where Email ='$Email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        ?> "
        <script>
            alert('Usuário já existe!');
            window.location.href = 'cadastro.php';
        </script>";
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
            header("Location:index.php");
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

