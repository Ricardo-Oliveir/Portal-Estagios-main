<?php
session_start();
include("db.php");
include("auth.php");

// Verifica se o usuário está logado
$user_data = check_login($conn);

// Verifica se o usuário logado é um professor (ou admin, se aplicável)
$is_professor = isset($user_data['role']) && ($user_data['role'] === 'professor' || $user_data['role'] === 'admin');

if ($_SERVER["REQUEST_METHOD"] == "POST" && $is_professor) {
    $usuario_id = $_POST['usuario_id'];
    $comentario = $_POST['comentario'];
    $autor = $user_data['nome']; // Nome do professor

    // Prepara a query para inserir o comentário no banco de dados
    $query_comentario = "INSERT INTO comentarios (usuario_id, comentario, data_envio, autor) VALUES (:usuario_id, :comentario, NOW(), :autor)";
    $stmt_comentario = $conn->prepare($query_comentario);
    $stmt_comentario->bindParam(':usuario_id', $usuario_id);
    $stmt_comentario->bindParam(':comentario', $comentario);
    $stmt_comentario->bindParam(':autor', $autor);

    // Executa a query
    if ($stmt_comentario->execute()) {
        // Comentário inserido com sucesso
        header("Location: dashboard.php"); // Redireciona após inserção para evitar reenvio ao recarregar
        exit();
    } else {
        // Erro ao inserir o comentário
        echo "Erro ao inserir o comentário: " . $stmt_comentario->errorInfo()[2];
    }
} else {
    echo "Você não tem permissão para acessar esta página!";
    exit();
}
?>
