<?php
session_start();
include('db.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $userId = $_SESSION['user_id'];

    
    $nome = $_POST['nome'];
    $ra = $_POST['ra'];
    $nomeEmpresa = $_POST['nomeEmpresa'];
    $nomeSupervisor = $_POST['nomeSupervisor'];
    $cargoSupervisor = $_POST['cargoSupervisor'];
    $resposta = $_POST['resposta'];
    $comentarios = $_POST['comentarios-observacoes'];
    $data = $_POST['data'];

    try {
        
        $sql = "INSERT INTO relatorio_parcial (users_id, nome, ra, nomeEmpresa, nomeSupervisor, cargoSupervisor, resposta, comentarios_observacoes, data)
                VALUES (:userId, :nome, :ra, :nomeEmpresa, :nomeSupervisor, :cargoSupervisor, :resposta, :comentarios, :data)
                ON DUPLICATE KEY UPDATE
                nome = VALUES(nome),
                ra = VALUES(ra),
                nomeEmpresa = VALUES(nomeEmpresa),
                nomeSupervisor = VALUES(nomeSupervisor),
                cargoSupervisor = VALUES(cargoSupervisor),
                resposta = VALUES(resposta),
                comentarios_observacoes = VALUES(comentarios_observacoes),
                data = VALUES(data)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':ra', $ra);
        $stmt->bindParam(':nomeEmpresa', $nomeEmpresa);
        $stmt->bindParam(':nomeSupervisor', $nomeSupervisor);
        $stmt->bindParam(':cargoSupervisor', $cargoSupervisor);
        $stmt->bindParam(':resposta', $resposta);
        $stmt->bindParam(':comentarios', $comentarios);
        $stmt->bindParam(':data', $data);

        // Executa a consulta
        $stmt->execute();

        echo "Dados gravados com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao gravar os dados: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
