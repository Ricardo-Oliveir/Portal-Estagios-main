<?php
session_start();
include("db.php");
include("auth.php");

// Certifique-se de que o usuário está logado como administrador
$user_data = check_login($conn);
$is_admin = isset($user_data['role']) && $user_data['role'] === 'admin';

if (!$is_admin) {
    echo "Você não tem permissão para acessar esta página!";
    exit();
}

// Consulta para buscar todos os usuários que não são administradores
$query = "SELECT * FROM users WHERE role = 'user'";
$stmt = $conn->query($query);

if ($stmt !== false) {
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Erro ao executar a consulta: " . $conn->errorInfo()[2];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevFlix - Usuários</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="display-4">Lista de Usuários</h1>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="index.php">Página Inicial</a>
                <a class="navbar-brand" href="logout.php">Sair</a>
            </nav>
        </div>
    </header>
    <div class="container mt-5">
        <div class="row" data-aos="fade-up">
            <?php
            if (!empty($users)) {
                foreach ($users as $user) {
                    $id = $user['id'];
                    $nome = $user['nome'];
                    $email = $user['email'];

                    // Consultar documentos do usuário
                    $documentQuery = "SELECT * FROM documentos WHERE usuario_id = :usuario_id";
                    $stmtDoc = $conn->prepare($documentQuery);
                    $stmtDoc->execute(['usuario_id' => $id]);
                    $documents = $stmtDoc->fetchAll(PDO::FETCH_ASSOC);

                    // Consultar comentários do usuário
                    $commentQuery = "SELECT * FROM comentarios WHERE usuario_id = :usuario_id";
                    $stmtCom = $conn->prepare($commentQuery);
                    $stmtCom->execute(['usuario_id' => $id]);
                    $comments = $stmtCom->fetchAll(PDO::FETCH_ASSOC);

                    echo "
                    <div class='col-md-12 mb-4' data-aos='zoom-in'>
                        <div class='card'>
                            <div class='card-body'>
                                <h5 class='card-title'>Usuário: {$nome}</h5>
                                <p class='card-text'>Email: {$email}</p>
                                <h6 class='mt-3'>Documentos:</h6>";

                    if (!empty($documents)) {
                        foreach ($documents as $doc) {
                            $doc_name = htmlspecialchars($doc['nome']);
                            $doc_status = htmlspecialchars($doc['status']);
                            $doc_date = date('d/m/Y H:i:s', strtotime($doc['data_envio']));
                            $doc_file = htmlspecialchars($doc['arquivo']);

                            // Formulário para atualizar o status do documento
                            echo "
                            <form action='atualizar_status.php' method='post'>
                                <input type='hidden' name='documento_id' value='{$doc['id']}'>
                                <div class='form-group'>
                                    <label for='status'>Status:</label>
                                    <select class='form-control' name='status' id='status'>
                                        <option value='aprovado' " . ($doc_status == 'aprovado' ? 'selected' : '') . ">Aprovado</option>
                                        <option value='analisando' " . ($doc_status == 'analisando' ? 'selected' : '') . ">Analisando</option>
                                        <option value='reprovado' " . ($doc_status == 'reprovado' ? 'selected' : '') . ">Reprovado</option>
                                    </select>
                                </div>
                                <button type='submit' class='btn btn-primary'>Atualizar Status</button>
                            </form>
                            ";

                            echo "<p>Documento: {$doc_name} - Status: {$doc_status} - Enviado em: {$doc_date} - <a href='{$doc_file}' download>Baixar</a></p>";
                        }
                    } else {
                        echo "<p>Nenhum documento encontrado.</p>";
                    }

                    echo "<h6 class='mt-3'>Comentários:</h6>";
                    if (!empty($comments)) {
                        foreach ($comments as $com) {
                            $com_text = htmlspecialchars($com['comentario']);
                            $com_date = date('d/m/Y H:i:s', strtotime($com['data_envio']));
                            $com_author = htmlspecialchars($com['autor']); // Nome do autor do comentário
                            echo "<p><strong>{$com_author}:</strong> {$com_text} - Enviado em: {$com_date}</p>";
                        }
                    } else {
                        echo "<p>Nenhum comentário encontrado.</p>";
                    }

                    echo "
                                <form action='add_comment.php' method='post' class='mt-3'>
                                    <input type='hidden' name='usuario_id' value='{$id}'>
                                    <div class='form-group'>
                                        <label for='comentario'>Adicionar Comentário:</label>
                                        <textarea class='form-control' name='comentario' id='comentario' rows='3' required></textarea>
                                    </div>
                                    <button type='submit' class='btn btn-primary'>Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>";
                }
            } else {
                echo "<p>Nenhum usuário encontrado.</p>";
            }
            ?>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Fatec.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
