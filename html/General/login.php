<?php
session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";  // Coloque a senha do seu banco de dados aqui
$dbname = "portal_editais";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_completo = $_POST['nome_completo'];
    $matricula = $_POST['matricula'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];
    if ($senha !== $confirma_senha) {
        echo "As senhas não coincidem.";
        exit();
    }

    // Proteção contra SQL Injection
    $nome_completo = $conn->real_escape_string($nome_completo);
    $matricula = $conn->real_escape_string($matricula);
    $telefone = $conn->real_escape_string($telefone);
    $email = $conn->real_escape_string($email);
    $senha = password_hash($conn->real_escape_string($senha), PASSWORD_DEFAULT); // Hash da senha
    $fatec = $conn->real_escape_string($fatec);

    // Verifica se o email já está cadastrado
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Email já cadastrado.";
        exit();
    }

    // Insere os dados no banco de dados
    $sql = "INSERT INTO users (nome_completo, matricula, telefone, email, senha, fatec) VALUES ('$nome_completo', '$matricula', '$telefone', '$email', '$senha', '$fatec')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso.";
        header("Location: login.html");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
