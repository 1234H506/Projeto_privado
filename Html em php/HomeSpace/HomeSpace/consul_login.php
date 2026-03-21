<?php
session_start();

include 'conexao.php';  

$email = $_POST['Email_Usuario'];
$senha = $_POST['Senha_Usuario'];

// criptografa com md5
$Senha_encrip = md5($senha);

// Pedido de busca para o banco de dados  
$sql = "SELECT Password, Email, administrador, Nome, ID_Utilizador FROM utilizador WHERE Email = '$email'";

$result = $conn->query($sql);

// Verifica se o utilizador foi encontrado
if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $password_bd = $row["Password"];
    $admin = $row["administrador"];

    // Se a senha registrada for igual à senha digitada pelo usuário
    if ($password_bd == $Senha_encrip) {

        $_SESSION["email"] = $row["Email"];
        $_SESSION["nome"] = $row["Nome"];
        $_SESSION["id"] = $row["ID_Utilizador"];

        // Se for administrador
        if ($admin == 1) {
            $_SESSION["admin"] = $admin; 
            header("Location: /administracao1/startbootstrap-sb-admin-2-gh-pages/index.php");
            exit();
        }
        // Usuário normal
        else {
            $_SESSION["email"] = $row["Email"];
            $_SESSION["nome"]  = $row["Nome"];
            $_SESSION["id"]    = $row["ID_Utilizador"];

            header("Location: index.php");
            exit();
        }
    } else {
        echo "<script>
            alert('Senha incorreta!');
            window.location.href='index.php';
        </script>";
        exit();
    }
} else {
    echo "<script>
        alert('Email não encontrado!');
        window.location.href='index.php';
    </script>";
    exit();
}
?>