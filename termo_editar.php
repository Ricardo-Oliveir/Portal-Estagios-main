<?php
session_start();

require_once 'db.php'; 


if (!isset($_SESSION['user_id'])) {
    echo "Erro: Você precisa estar logado para adicionar um termo de estágio.";
    exit;
}


$user_id_logged_in = $_SESSION['user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        
        $concedente = $_POST['concedente'];
        $cnpj = $_POST['cnpj'];
        $nome_representante = $_POST['nome_representante'];
        $endereco_concedente = $_POST['endereco_concedente'];
        $cpf_representante = $_POST['cpf_representante'];
        $nome_estagiario = $_POST['nome_estagiario'];
        $rg_estagiario = $_POST['rg_estagiario'];
        $endereco_estagiario = $_POST['endereco_estagiario'];
        $cidade_estagiario = $_POST['cidade_estagiario'];
        $matricula = $_POST['matricula'];
        $nome = $_POST['nome'];
        $curso = $_POST['curso'];
        $semestre = $_POST['semestre'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $email = $_POST['email'];
        $horario_inicio = $_POST['horario_inicio'];
        $horario_fim = $_POST['horario_fim'];
        $refeicoes_inicio = $_POST['refeicoes_inicio'];
        $refeicoes_fim = $_POST['refeicoes_fim'];
        $horas_semanais = $_POST['horas_semanais'];
        $vigencia_inicio = $_POST['vigencia_inicio'];
        $vigencia_fim = $_POST['vigencia_fim'];
        $numero_apolice = $_POST['numero_apolice'];
        $cargo_supervisor = $_POST['cargo_supervisor'];
        $telefone_supervisor = $_POST['telefone_supervisor'];
        $email_representante = $_POST['email_representante'];

        $stmt = $conn->prepare("INSERT INTO termo (
            concedente, cnpj, nome_representante, endereco_concedente, cpf_representante, nome_estagiario, rg_estagiario, 
            endereco_estagiario, cidade_estagiario, matricula, nome, curso, semestre, endereco, 
            bairro, telefone, cep, cidade, estado, email, 
            horario_inicio, horario_fim, refeicoes_inicio, refeicoes_fim, horas_semanais, 
            vigencia_inicio, vigencia_fim, numero_apolice, cargo_supervisor, telefone_supervisor, email_representante, users_id
        ) VALUES (
            :concedente, :cnpj, :nome_representante, :endereco_concedente, :cpf_representante, :nome_estagiario, :rg_estagiario, 
            :endereco_estagiario, :cidade_estagiario, :matricula, :nome, :curso, :semestre, :endereco, 
            :bairro, :telefone, :cep, :cidade, :estado, :email, 
            :horario_inicio, :horario_fim, :refeicoes_inicio, :refeicoes_fim, :horas_semanais, 
            :vigencia_inicio, :vigencia_fim, :numero_apolice, :cargo_supervisor, :telefone_supervisor, :email_representante, :user_id
        )");

      
        $stmt->execute(array(
            ':concedente' => $concedente,
            ':cnpj' => $cnpj,
            ':nome_representante' => $nome_representante,
            ':endereco_concedente' => $endereco_concedente,
            ':cpf_representante' => $cpf_representante,
            ':nome_estagiario' => $nome_estagiario,
            ':rg_estagiario' => $rg_estagiario,
            ':endereco_estagiario' => $endereco_estagiario,
            ':cidade_estagiario' => $cidade_estagiario,
            ':matricula' => $matricula,
            ':nome' => $nome,
            ':curso' => $curso,
            ':semestre' => $semestre,
            ':endereco' => $endereco,
            ':bairro' => $bairro,
            ':telefone' => $telefone,
            ':cep' => $cep,
            ':cidade' => $cidade,
            ':estado' => $estado,
            ':email' => $email,
            ':horario_inicio' => $horario_inicio,
            ':horario_fim' => $horario_fim,
            ':refeicoes_inicio' => $refeicoes_inicio,
            ':refeicoes_fim' => $refeicoes_fim,
            ':horas_semanais' => $horas_semanais,
            ':vigencia_inicio' => $vigencia_inicio,
            ':vigencia_fim' => $vigencia_fim,
            ':numero_apolice' => $numero_apolice,
            ':cargo_supervisor' => $cargo_supervisor,
            ':telefone_supervisor' => $telefone_supervisor,
            ':email_representante' => $email_representante,
            ':user_id' => $user_id_logged_in
        ));

        
        echo "Termo de Estágio adicionado com sucesso!";
    } catch (PDOException $e) {

        echo "Erro ao adicionar os dados do termo de estágio: " . $e->getMessage();
    }
}
?>
