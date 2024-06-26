<?php
session_start();
include("db.php");
include("auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['documento_id']) && isset($_POST['status'])) {
    $documento_id = $_POST['documento_id'];
    $novo_status = $_POST['status'];

    // Atualizar o status do documento no banco de dados
    $query = "UPDATE documentos SET status = :status WHERE id = :documento_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':status', $novo_status);
    $stmt->bindParam(':documento_id', $documento_id);

    if ($stmt->execute()) {
        // Redirecionar de volta para a página dashboard.php após a atualização
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Erro ao atualizar o status do documento.";
    }
} else {
    echo "Acesso inválido ao script.";
}
?>
