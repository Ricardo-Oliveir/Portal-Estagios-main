<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function check_login($conn)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_data['role'] = ($user_data['role'] == 'admin') ? 'admin' : 'user'; // Definir o papel (role) com base na regra existente
            return $user_data;
        }
    }

    // Redirecionar para a página de login se o usuário não estiver logado
    header("Location: login.php");
    die;
}
