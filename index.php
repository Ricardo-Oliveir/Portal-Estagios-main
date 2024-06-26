<?php
session_start();
include("db.php");
include("auth.php");

$user_data = check_login($conn);

// Processo para enviar comentário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentario'])) {
    $comentario = $_POST['comentario'];
    $usuario_id = $user_data['id'];
    $autor = $user_data['nome'];

    $query_comentario = "INSERT INTO comentarios (usuario_id, comentario, data_envio, autor) VALUES (:usuario_id, :comentario, NOW(), :autor)";
    $stmt_comentario = $conn->prepare($query_comentario);
    $stmt_comentario->bindParam(':usuario_id', $usuario_id);
    $stmt_comentario->bindParam(':comentario', $comentario);
    $stmt_comentario->bindParam(':autor', $autor);

    if ($stmt_comentario->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao inserir o comentário: " . $stmt_comentario->errorInfo()[2];
    }
}

// Consulta para recuperar documentos do usuário
$query_documentos = "
    SELECT d.*
    FROM documentos d
    WHERE d.usuario_id = :usuario_id
    ORDER BY d.data_envio DESC
";
$stmt_documentos = $conn->prepare($query_documentos);
$stmt_documentos->bindParam(':usuario_id', $user_data['id']);
$stmt_documentos->execute();
$documentos = $stmt_documentos->fetchAll(PDO::FETCH_ASSOC);

// Consulta para recuperar comentários do usuário
$query_comentarios = "SELECT * FROM comentarios WHERE usuario_id = :usuario_id ORDER BY data_envio DESC";
$stmt_comentarios = $conn->prepare($query_comentarios);
$stmt_comentarios->bindParam(':usuario_id', $user_data['id']);
$stmt_comentarios->execute();
$comentarios = $stmt_comentarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Aluno</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .btn-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
        }

        .list-group-item {
            margin-bottom: 10px;
        }

        .badge.aprovado {
            background-color: #28a745;
        }

        .badge.reprovado {
            background-color: #dc3545;
        }

        .badge.analise {
            background-color: #ffc107;
        }
    </style>
</head>

<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="display-4">Painel do Aluno</h1>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="index.php">Página Inicial</a>
                <a class="navbar-brand" href="logout.php">Sair</a>
            </nav>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="btn-group">
                    <a href="termo_form.php" class="btn btn-primary mr-3">Termo de Estágio</a>
                    <a href="relatorio-parcial.php" class="btn btn-primary mr-3">Relatório Parcial</a>
                    <a href="relatorio-final.php" class="btn btn-primary mr-3">Relatório Final</a>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="mt-4">
                    <div class="form-group">
                        <label for="documento" class="mr-2">Enviar Documento:</label>
                        <input type="file" id="documento" name="documento" class="mr-2">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-4">
                    <div class="form-group">
                        <label for="comentario">Enviar Comentário:</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>

                <h3 class="mt-4">Documentos Enviados:</h3>
                <ul class="list-group">
                    <?php if (!empty($documentos)) : ?>
                        <?php foreach ($documentos as $doc) : ?>
                            <li class="list-group-item">
                                <?php echo htmlspecialchars($doc['nome']); ?>
                                - Status: 
                                <?php if ($doc['status'] == 'aprovado') : ?>
                                    <span class="badge badge-pill badge-success aprovado">Aprovado</span>
                                <?php elseif ($doc['status'] == 'reprovado') : ?>
                                    <span class="badge badge-pill badge-danger reprovado">Reprovado</span>
                                <?php else : ?>
                                    <span class="badge badge-pill badge-warning analise">Em Análise</span>
                                <?php endif; ?>
                                - Enviado em: <?php echo date('d/m/Y H:i:s', strtotime($doc['data_envio'])); ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="list-group-item">Nenhum documento enviado.</li>
                    <?php endif; ?>
                </ul>

                <h3 class="mt-4">Comentários:</h3>
                <ul class="list-group">
                    <?php if (!empty($comentarios)) : ?>
                        <?php foreach ($comentarios as $comentario) : ?>
                            <li class="list-group-item">
                                <strong><?php echo htmlspecialchars($comentario['autor']); ?>:</strong> <?php echo htmlspecialchars($comentario['comentario']); ?>
                                - Enviado em: <?php echo date('d/m/Y H:i:s', strtotime($comentario['data_envio'])); ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="list-group-item">Nenhum comentário enviado.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Fatec.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
