<?php
session_start();
include('db.php');


$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$userId = $_SESSION['user_id'];


$relatorioSql = "SELECT * FROM relatorio_parcial WHERE users_id = :userId";
$relatorioStmt = $conn->prepare($relatorioSql);
$relatorioStmt->bindParam(':userId', $userId);
$relatorioStmt->execute();


$relatorioData = $relatorioStmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/relatorio-parcial.css">
    <title>Relatório Parcial</title>
</head>

<body>
    <div class="container">
        <h3>Relatório Parcial de Estágio</h3>
        <form action="relatorio_parcial_editar.php" method="POST">
            <div class="dados-estagiario">
                <h4 id="estagiario">1. Dados do Estagiário</h4>
                <p>Nome: <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($relatorioData['nome'] ?? ''); ?>"></p>
                <p>RA: <input type="number" name="ra" id="ra" value="<?php echo htmlspecialchars($relatorioData['ra'] ?? ''); ?>"></p>
                <p>Curso: DSM - Desenvolvimento de Software Multiplataforma</p>
            </div>
            <div class="dados-empresa">
                <h4>2. Dados da Empresa Concedente</h4>
                <p>Nome da Empresa: <input type="text" name="nomeEmpresa" id="nomeEmpresa" value="<?php echo htmlspecialchars($relatorioData['nomeEmpresa'] ?? ''); ?>"></p>
                <p>Nome do Supervisor do Estagiário: <input type="text" name="nomeSupervisor" id="nomeSupervisor" value="<?php echo htmlspecialchars($relatorioData['nomeSupervisor'] ?? ''); ?>"></p>
                <p>Cargo do Supervisor do Estagiário: <input type="text" name="cargoSupervisor" id="cargoSupervisor" value="<?php echo htmlspecialchars($relatorioData['cargoSupervisor'] ?? ''); ?>"></p>
            </div>
            <div class="avaliacao">
                <h4>3. Avaliação do Supervisor</h4>
                <p>Nos últimos 6 meses, as atividades descritas no plano de atividades foram efetivamente realizadas pelo estagiário? <input type="text" name="resposta" id="resposta" value="<?php echo htmlspecialchars($relatorioData['resposta'] ?? ''); ?>"></p>
                <p>
                    a. Assiduidade e pontualidade <br>
                    b. Capacidade de trabalhar em equipe <br>
                    c. Conhecimentos teóricos e capacidade técnica <br>
                    d. Criatividade e capacidade de inovação <br>
                    e. Expressão oral e escrita <br>
                    f. Iniciativa e capacidade de liderança <br>
                    g. Interesse pela empresa e pela área de atuação <br>
                    h. Motivação e proatividade <br>
                    i. Profissionalismo e comportamento <br>
                    j. Relacionamento interpessoal <br>
                    k. Comprometimento
                </p>
            </div>
            <div class="comentarios-observacoes">
                <h4>4. Comentários e Observações</h4>
                <textarea name="comentarios-observacoes" id="comentarios-observacoes"><?php echo htmlspecialchars($relatorioData['comentarios_observacoes'] ?? ''); ?></textarea>
            </div>
            <p>Data: <input type="date" name="data" id="data" value="<?php echo htmlspecialchars($relatorioData['data'] ?? ''); ?>"></p>
            <br><br>
            <div class="assinaturas">
                <p>Estagiário</p>
                <p>Supervisor do Estagiário</p>
                <p>Professor Orientador</p>
            </div>
            <input type="submit" value="Gravar">
        </form>
    </div>
</body>

</html>