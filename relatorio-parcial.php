<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/relatorio-parcial.css">
    <title>Relatório Parcial</title>
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

        h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        h4 {
            font-size: 18px;
            margin: 20px 0 10px;
            text-align: left;
        }

        p {
            text-align: left;
            margin: 10px 0;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
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

        textarea {
            height: 100px;
        }

        input[type="submit"] {
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

        .assinaturas {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .assinaturas p {
            width: 30%;
            border-top: 1px solid #000;
            padding-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Relatório Parcial de Estágio</h3>
        <form action="relatorio_parcial_editar.php" method="POST">
            <div class="dados-estagiario">
                <h4 id="estagiario">1. Dados do Estagiário</h4>
                <p>Nome: <input type="text" name="nome" id="nome" required></p>
                <p>RA: <input type="number" name="ra" id="ra" required></p>
                <p>Curso: DSM - Desenvolvimento de Software Multiplataforma</p>
            </div>

            <div class="dados-empresa">
                <h4>2. Dados da Empresa Concedente</h4>
                <p>Nome da Empresa: <input type="text" name="nomeEmpresa" id="nomeEmpresa" required></p>
                <p>Nome do Supervisor do Estagiário: <input type="text" name="nomeSupervisor" id="nomeSupervisor" required></p>
                <p>Cargo do Supervisor do Estagiário: <input type="text" name="cargoSupervisor" id="cargoSupervisor" required></p>
            </div>

            <div class="avaliacao">
                <h4>3. Avaliação do Supervisor</h4>
                <p>Nos últimos 6 meses, as atividades descritas no plano de atividades foram efetivamente realizadas pelo estagiário? <input type="text" name="resposta" id="resposta" required></p>
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
                <textarea name="comentarios_observacoes" id="comentarios-observacoes" required></textarea>
            </div>

            <p>Data: <input type="date" name="data" id="data" required></p>
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