<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termo de Compromisso de Estágio</title>
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

        .termo form {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            text-align: left;
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
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Termo de Compromisso para a Realização de Estágio Supervisionado Obrigatório Remunerado</h1>
            <p>(Lei nº 11.788/08)</p>
        </header>
        <section class="termo">
            <form action="termo_editar.php" method="POST">
                <!-- Dados do concedente -->
                <label for="concedente" class="form-label">Concedente:</label>
                <input type="text" id="concedente" name="concedente" class="form-input" placeholder="Concedente">

                <label for="cnpj" class="form-label">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" class="form-input" placeholder="CNPJ">

                <label for="endereco_concedente" class="form-label">Endereço do Concedente:</label>
                <input type="text" id="endereco_concedente" name="endereco_concedente" class="form-input"
                    placeholder="Endereço do Concedente">

                <label for="nome_representante" class="form-label">Nome do Representante:</label>
                <input type="text" id="nome_representante" name="nome_representante" class="form-input"
                    placeholder="Nome do Representante">

                <label for="cpf_representante" class="form-label">CPF do Representante:</label>
                <input type="text" id="cpf_representante" name="cpf_representante" class="form-input"
                    placeholder="CPF do Representante">

                <!-- Dados do estagiário -->
                <label for="nome_estagiario" class="form-label">Nome do Estagiário:</label>
                <input type="text" id="nome_estagiario" name="nome_estagiario" class="form-input"
                    placeholder="Nome do Estagiário">

                <label for="rg_estagiario" class="form-label">RG do Estagiário:</label>
                <input type="text" id="rg_estagiario" name="rg_estagiario" class="form-input"
                    placeholder="RG do Estagiário">

                <label for="endereco_estagiario" class="form-label">Endereço do Estagiário:</label>
                <input type="text" id="endereco_estagiario" name="endereco_estagiario" class="form-input"
                    placeholder="Endereço do Estagiário">

                <label for="cidade_estagiario" class="form-label">Cidade do Estagiário:</label>
                <input type="text" id="cidade_estagiario" name="cidade_estagiario" class="form-input"
                    placeholder="Cidade do Estagiário">

                <!-- Informações do estudante -->
                <label for="matricula" class="form-label">Matrícula:</label>
                <input type="text" id="matricula" name="matricula" class="form-input" placeholder="Matrícula">

                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-input" placeholder="Nome">

                <label for="curso" class="form-label">Curso:</label>
                <input type="text" id="curso" name="curso" class="form-input" placeholder="Curso">

                <label for="semestre" class="form-label">Semestre:</label>
                <input type="text" id="semestre" name="semestre" class="form-input" placeholder="Semestre">

                <label for="endereco" class="form-label">Endereço domiciliar:</label>
                <input type="text" id="endereco" name="endereco" class="form-input" placeholder="Endereço domiciliar">

                <label for="bairro" class="form-label">Bairro:</label>
                <input type="text" id="bairro" name="bairro" class="form-input" placeholder="Bairro">

                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-input" placeholder="Telefone">

                <label for="cep" class="form-label">CEP:</label>
                <input type="text" id="cep" name="cep" class="form-input" placeholder="CEP">

                <label for="cidade" class="form-label">Cidade:</label>
                <input type="text" id="cidade" name="cidade" class="form-input" placeholder="Cidade">

                <label for="estado" class="form-label">Estado:</label>
                <input type="text" id="estado" name="estado" class="form-input" placeholder="Estado">

                <label for="email" class="form-label">Endereço eletrônico (e-mail):</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="Endereço eletrônico (e-mail)">

                <label for="horario_inicio" class="form-label">Horário de Início:</label>
                <input type="text" id="horario_inicio" name="horario_inicio" class="form-input"
                    placeholder="Horário de Início">

                <label for="horario_fim" class="form-label">Horário de Término:</label>
                <input type="text" id="horario_fim" name="horario_fim" class="form-input" placeholder="Horário de Término">

                <label for="refeicoes_inicio" class="form-label">Início do Intervalo para Refeições:</label>
                <input type="text" id="refeicoes_inicio" name="refeicoes_inicio" class="form-input"
                    placeholder="Início do Intervalo para Refeições">

                <label for="refeicoes_fim" class="form-label">Término do Intervalo para Refeições:</label>
                <input type="text" id="refeicoes_fim" name="refeicoes_fim" class="form-input"
                    placeholder="Término do Intervalo para Refeições">

                <label for="horas_semanais" class="form-label">Horas Semanais:</label>
                <input type="text" id="horas_semanais" name="horas_semanais" class="form-input"
                    placeholder="Horas Semanais">

                <label for="vigencia_inicio" class="form-label">Início da Vigência:</label>
                <input type="date" id="vigencia_inicio" name="vigencia_inicio" class="form-input">

                <label for="vigencia_fim" class="form-label">Término da Vigência:</label>
                <input type="date" id="vigencia_fim" name="vigencia_fim" class="form-input">

                <label for="numero_apolice" class="form-label">Número da Apólice:</label>
                <input type="text" id="numero_apolice" name="numero_apolice" class="form-input"
                    placeholder="Número da Apólice">

                <label for="cargo_supervisor" class="form-label">Cargo do Supervisor:</label>
                <input type="text" id="cargo_supervisor" name="cargo_supervisor" class="form-input"
                    placeholder="Cargo do Supervisor">

                <label for="telefone_supervisor" class="form-label">Contato do Supervisor (Telefone):</label>
                <input type="text" id="telefone_supervisor" name="telefone_supervisor" class="form-input"
                    placeholder="Contato do Supervisor (Telefone)">

                <label for="email_representante" class="form-label">Endereço Eletrônico do Representante (e-mail):</label>
                <input type="email" id="email_representante" name="email_representante" class="form-input"
                    placeholder="Endereço Eletrônico do Representante (e-mail)">

                <button type="submit" class="form-submit">Gravar no Banco de Dados</button>
            </form>

            <button onclick="location.href='visualizartermo.php'" class="form-submit">Visualizar Termo</button>
        </section>
    </div>
</body>

</html>
