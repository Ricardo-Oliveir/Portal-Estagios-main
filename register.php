<?php
session_start();
include("db.php");


$query = "SELECT curso_id, nome FROM cursos";
$stmt = $conn->query($query);
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getNomeCompletoCurso($nome)
{
    switch ($nome) {
        case 'ge':
            return 'Gestão Empresarial (GE)';
        case 'gpi':
            return 'Gestão da Produção Industrial (GPI)';
        case 'dsm':
            return 'Desenvolvimento de Software Multiplataforma (DSM)';
        default:
            return $nome;
    }
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $curso_id = $_POST['curso_id'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($username) && !empty($password) && !empty($curso_id)) {
        try {
            // Verificar se o nome de usuário já existe
            $query = "SELECT * FROM users WHERE nome = :username LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                // Inserir novo usuário
                $query = "INSERT INTO users (nome, senha) VALUES (:username, :hashed_password)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':hashed_password', $hashed_password);
                $stmt->execute();

                // Obter o id do novo usuário
                $user_id = $conn->lastInsertId();

                // Atualizar a tabela cursos com o user_id
                $query = "UPDATE cursos SET user_id = :user_id WHERE curso_id = :curso_id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':curso_id', $curso_id);
                $stmt->execute();

                echo "Usuário registrado com sucesso!";
            } else {
                $error_message = "Nome de usuário já existe!";
            }
        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    } else {
        $error_message = "Por favor, preencha todas as informações!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>devflix</title>
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
        <div class="signup">
            <h1>Registro de Usuário</h1>
            <?php if (!empty($error_message)) : ?>
                <div class="error-message"><?= $error_message ?></div>
            <?php endif; ?>
            <form method="post">
                <label for="username">Nome de Usuário:</label>
                <input type="text" id="username" name="username" required>
                <br>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <label for="curso_id">Curso:</label>
                <select id="curso_id" name="curso_id" required>
                    <?php foreach ($cursos as $curso) : ?>
                        <option value="<?= $curso['curso_id'] ?>"><?= getNomeCompletoCurso($curso['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <button type="submit">Registrar</button>
                <button><a href="login.php">login</a></button>
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