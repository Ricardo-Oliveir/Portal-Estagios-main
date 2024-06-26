<?php
session_start();
include("db.php");

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        try {
            // Preparar a consulta
            $query = "SELECT * FROM users WHERE nome = :username LIMIT 1";
            $stmt = $conn->prepare($query);

            // Executar a consulta com parâmetros
            $stmt->execute([':username' => $username]);

            // Verificar se encontrou algum usuário
            if ($stmt->rowCount() > 0) {
                $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verificar se a senha está correta
                if (password_verify($password, $user_data['senha'])) {
                    $_SESSION['user_id'] = $user_data['id'];
                    $_SESSION['role'] = $user_data['role'];

                    // Redirecionar baseado no tipo de usuário
                    if ($user_data['role'] == 'admin') {
                        header("Location: dashboard.php");
                    } else {
                        header("Location: index.php");
                    }
                    exit();
                } else {
                    $error_message = "Senha incorreta!";
                }
            } else {
                $error_message = "Nome de usuário não encontrado!";
            }
        } catch (PDOException $e) {
            $error_message = "Erro: " . $e->getMessage();
        }
    } else {
        $error_message = "Por favor, preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="main">
        <div class="login">
            <?php if (!empty($error_message)) : ?>
                <div class="error-message"><?= $error_message ?></div>
            <?php endif; ?>
            <form method="post">
                <h1>clique aqui para logar</h1>
                <label for="username">Digite seu nome:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Digite sua Senha:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Login">
                <button><a href="register.php">Registrar</a></button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>

</html>