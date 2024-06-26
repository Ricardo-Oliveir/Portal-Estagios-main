<?php
// Adicione aqui o seu código PHP se necessário
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Final de Estágio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            width: 90%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .section-title {
            font-weight: bold;
            margin: 20px 0 10px;
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .form-input {
            width: calc(100% - 30px);
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            margin-left: 15px;
        }

        .evaluation-table th,
        .evaluation-table td {
            text-align: center;
        }

        .evaluation-table input[type="radio"] {
            margin: 0;
        }

        textarea {
            width: calc(100% - 30px);
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            margin-left: 15px;
        }

        .form-submit {
            padding: 15px 0;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            margin-top: 20px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }

        .footer {
            text-align: left;
            margin-top: 20px;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Relatório Final de Estágio</h1>
        </header>
        <form action="relatorio_final_editar.php" method="POST">
            <div class="section">
                <div class="section-title">Dados do Estagiário</div>
                <table>
                    <tr>
                        <th>Nome</th>
                        <td><input type="text" name="nome" class="form-input"></td>
                    </tr>
                    <tr>
                        <th>RA</th>
                        <td><input type="text" name="ra" class="form-input"></td>
                    </tr>
                    <tr>
                        <th>Curso</th>
                        <td><input type="text" name="curso" class="form-input" value="DSM - Desenvolvimento de Software Multiplataforma"></td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">Dados da Empresa Concedente</div>
                <table>
                    <tr>
                        <th>Nome da empresa</th>
                        <td><input type="text" name="nome_empresa" class="form-input"></td>
                    </tr>
                    <tr>
                        <th>Nome do supervisor do estagiário</th>
                        <td><input type="text" name="nome_supervisor" class="form-input"></td>
                    </tr>
                    <tr>
                        <th>Cargo do supervisor do estagiário</th>
                        <td><input type="text" name="cargo_supervisor" class="form-input"></td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">Período</div>
                <table>
                    <tr>
                        <th>Data de início do estágio</th>
                        <td><input type="date" name="data_inicio" class="form-input"></td>
                    </tr>
                    <tr>
                        <th>Data de término do estágio</th>
                        <td><input type="date" name="data_termino" class="form-input"></td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">Atividades realizadas no Estágio (preenchido pelo estagiário)</div>
                <textarea name="atividades" rows="5" placeholder="Descreva as principais atividades desenvolvidas durante o estágio." class="form-input"></textarea>
                <textarea name="expectativas" rows="5" placeholder="As atividades realizadas atenderam às suas expectativas? Explique." class="form-input"></textarea>
                <textarea name="aplicacao_conhecimentos" rows="5" placeholder="Por meio das atividades desenvolvidas no estágio você teve condições de aplicar os conhecimentos teóricos e práticos obtidos durante o curso? Explique." class="form-input"></textarea>
                <textarea name="desafios" rows="5" placeholder="Descreva os principais desafios encontrados no seu estágio e como foram resolvidos." class="form-input"></textarea>
            </div>

            <div class="section">
                <div class="section-title">Avaliação do Supervisor</div>
                <table class="evaluation-table">
                    <tr>
                        <th>Habilidades</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                    </tr>
                    <tr>
                        <td>Planejamento</td>
                        <td><input type="radio" name="planejamento" value="1"></td>
                        <td><input type="radio" name="planejamento" value="2"></td>
                        <td><input type="radio" name="planejamento" value="3"></td>
                        <td><input type="radio" name="planejamento" value="4"></td>
                        <td><input type="radio" name="planejamento" value="5"></td>
                        <td><input type="radio" name="planejamento" value="6"></td>
                        <td><input type="radio" name="planejamento" value="7"></td>
                        <td><input type="radio" name="planejamento" value="8"></td>
                        <td><input type="radio" name="planejamento" value="9"></td>
                        <td><input type="radio" name="planejamento" value="10"></td>
                    </tr>
                    <tr>
                        <td>Qualidade do Trabalho</td>
                        <td><input type="radio" name="qualidade" value="1"></td>
                        <td><input type="radio" name="qualidade" value="2"></td>
                        <td><input type="radio" name="qualidade" value="3"></td>
                        <td><input type="radio" name="qualidade" value="4"></td>
                        <td><input type="radio" name="qualidade" value="5"></td>
                        <td><input type="radio" name="qualidade" value="6"></td>
                        <td><input type="radio" name="qualidade" value="7"></td>
                        <td><input type="radio" name="qualidade" value="8"></td>
                        <td><input type="radio" name="qualidade" value="9"></td>
                        <td><input type="radio" name="qualidade" value="10"></td>
                    </tr>
                    <tr>
                        <td>Pontualidade e Assiduidade</td>
                        <td><input type="radio" name="pontualidade" value="1"></td>
                        <td><input type="radio" name="pontualidade" value="2"></td>
                        <td><input type="radio" name="pontualidade" value="3"></td>
                        <td><input type="radio" name="pontualidade" value="4"></td>
                        <td><input type="radio" name="pontualidade" value="5"></td>
                        <td><input type="radio" name="pontualidade" value="6"></td>
                        <td><input type="radio" name="pontualidade" value="7"></td>
                        <td><input type="radio" name="pontualidade" value="8"></td>
                        <td><input type="radio" name="pontualidade" value="9"></td>
                        <td><input type="radio" name="pontualidade" value="10"></td>
                    </tr>
                </table>
                <textarea name="comentarios_supervisor" rows="5" placeholder="Comentários adicionais do supervisor" class="form-input"></textarea>
            </div>

            <div class="section">
                <input type="submit" value="Enviar Relatório" class="form-submit">
            </div>
        </form>

        <div class="footer">
            <p>Data: <input type="date" name="data" class="form-input" style="width:auto;"></p>
            <p>Assinatura do Supervisor: ____________________________</p>
            <p>Assinatura do Estagiário: ____________________________</p>
        </div>
    </div>
</body>

</html>