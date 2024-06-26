<?php
session_start();

include('db.php');


$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$userId = $_SESSION['user_id'];


$termoSql = "SELECT t.*
              FROM termo t
              INNER JOIN users u ON t.users_id = u.id
              WHERE u.id = :userId";
$termoStmt = $conn->prepare($termoSql);
$termoStmt->bindParam(':userId', $userId);
$termoStmt->execute();

if ($termoStmt->rowCount() > 0) {
    $termoData = $termoStmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "No termo found for user with ID: " . $userId;
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termo de Compromisso de Estágio</title>
    <link rel="stylesheet" href="./css/termo.css">

</head>

<body>
    <div class="container">
        <header>
            <h1>Termo de Compromisso para a Realização de Estágio Supervisionado Obrigatório Não Remunerado</h1>
            <p>(Lei nº 11.778/08)</p>
        </header>
        <section class="termo">
            <form action="generate_pdf.php" method="POST">
                <p>Pelo presente instrumento as partes a seguir nomeadas e ao final assinadas de um lado</p>
                <input type="text" class="concedente" name="concedente" value="<?php echo $termoData['concedente']; ?>" placeholder="Concedente">
                <p>inscrita no CNPJ sob o nº</p>
                <input type="text" class="cnpj" name="cnpj" value="<?php echo $termoData['cnpj']; ?>" placeholder="CNPJ">
                <p>sita à rua</p>
                <input type="text" class="endereco_concedente" name="endereco_concedente" value="<?php echo $termoData['endereco_concedente']; ?>" placeholder="Endereço Concedente">
                <p>doravante denominada CONCEDENTE neste ato representada por</p>
                <input type="text" class="nome_representante" name="nome_representante" value="<?php echo $termoData['nome_representante']; ?>" placeholder="Nome do Representante">
                <p>(Cargo ou função do representante) portador do CPF nº</p>
                <input type="text" class="cpf_representante" name="cpf_representante" value="<?php echo $termoData['cpf_representante']; ?>" placeholder="CPF do Representante">
                <p>e de outro lado o(a) estudante</p>
                <input type="text" class="nome_estagiario" name="nome_estagiario" value="<?php echo $termoData['nome_estagiario']; ?>" placeholder="Nome do Estagiário">
                <p>RG nº</p>
                <input type="text" class="rg_estagiario" name="rg_estagiario" value="<?php echo $termoData['rg_estagiario']; ?>" placeholder="RG do Estagiário">
                <p>residente à</p>
                <input type="text" class="endereco_estagiario" name="endereco_estagiario" value="<?php echo $termoData['endereco_estagiario']; ?>" placeholder="Endereço do Estagiário">
                <p>na cidade de</p>
                <input type="text" class="cidade_estagiario" name="cidade_estagiario" value="<?php echo $termoData['cidade_estagiario']; ?>" placeholder="Cidade do Estagiário">
                <p>doravante denominado ESTAGIÁRIO (A) aluno (a) regularmente matriculado (a) no Curso Superior de Tecnologia em Desenvolvimento de Software Multiplataforma da Faculdade de Tecnologia de Itapira – Fatec “Ogari de Castro Pacheco” inscrita no CNPJ sob o nº 62.823.257/0278-05 localizada na cidade de Itapira Estado de São Paulo doravante denominada INSTITUIÇÃO DE ENSINO na condição de interveniente acordam e estabelecem entre si as cláusulas e condições que regerão este TERMO DE COMPROMISSO DE ESTÁGIO OBRIGATÓRIO NÃO REMUNERADO.</p>

                <h2>Cláusulas</h2>
                <h3>Cláusula Primeira</h3>
                <p>É objeto do presente Termo de Compromisso de Estágio autorizar a realização de estágio nos termos da Lei 11.788/08 de 25/09/2008 com a finalidade de possibilitar ao (à) Estagiário (a) complementação e aperfeiçoamento prático de seu Curso Superior de Tecnologia celebrado entre a Concedente e a Instituição de Ensino da qual o (a) Estagiário (a) é aluno (a).</p>
                <p>Parágrafo Primeiro. Entende-se por estágio profissional aquele desenvolvido em ambiente real de trabalho assumido como ato educativo e supervisionado pela instituição de ensino em regime de parceria com organizações do mundo do trabalho objetivando efetiva preparação do estudante para o trabalho conforme o art. 34 § 1º da Resolução CNE/CP Nº 1/2021.</p>
                <p>Parágrafo Segundo. As atividades de estágio somente poderão ser iniciadas após assinatura do Termo de Compromisso de Estágio pelas partes envolvidas não sendo reconhecida ou validada com data retroativa.</p>
                <p>Parágrafo Terceiro. Em caso de prorrogação de vigência do Termo de Compromisso de Estágio o preenchimento e a assinatura do Termo Aditivo deverão ser providenciados com antecedência de 20 (vinte) dias antes da data de encerramento contida neste Termo de Compromisso.</p>
                <h3>Cláusula Segunda</h3>
                <p>As atividades a serem desenvolvidas durante o Estágio objeto do presente Termo de Compromisso constarão de Plano de Estágio construído pelo (a) Estagiário (a) em conjunto com a Concedente e orientado por professor da Instituição de Ensino.</p>
                <p>Parágrafo primeiro: O Plano de Atividade de Estágio – PAE está anexo ao Termo de Compromisso de Estágio.</p>
                <h2>Cláusula Terceira</h2>
                <p>Fica compromissado entre as partes que:</p>

                <p>I - As atividades do Estágio a serem cumpridas pelo (a) Estagiário (a) serão no horário das</p>
                <input type="time" id="horario_inicio" name="horario_inicio" value="<?php echo isset($termoData['horario_inicio']) ? $termoData['horario_inicio'] : ''; ?>" required>
                <p>às</p>
                <input type="time" id="horario_fim" name="horario_fim" value="<?php echo isset($termoData['horario_fim']) ? $termoData['horario_fim'] : ''; ?>" required>
                <p>horas, com intervalo das refeições das</p>
                <input type="time" id="refeicoes_inicio" name="refeicoes_inicio" value="<?php echo isset($termoData['refeicoes_inicio']) ? $termoData['refeicoes_inicio'] : ''; ?>" required>
                <p>às</p>
                <input type="time" id="refeicoes_fim" name="refeicoes_fim" value="<?php echo isset($termoData['refeicoes_fim']) ? $termoData['refeicoes_fim'] : ''; ?>" required>
                <p>horas, de segunda-feira a sexta-feira, perfazendo</p>
                <input type="number" id="horas_semanais" name="horas_semanais" value="<?php echo isset($termoData['horas_semanais']) ? $termoData['horas_semanais'] : ''; ?>" placeholder="Total de horas semanais" required>
                <p>horas semanais;</p>

                <p>II - A jornada de atividade do (a) Estagiário (a) deverá compatibilizar-se com o horário escolar do (a) Estagiário (a) e com o horário da Concedente;</p>

                <p>III - Este Termo de Compromisso terá vigência de</p>
                <input type="date" id="vigencia_inicio" name="vigencia_inicio" value="<?php echo isset($termoData['vigencia_inicio']) ? $termoData['vigencia_inicio'] : ''; ?>" required>
                <p>a</p>
                <input type="date" id="vigencia_fim" name="vigencia_fim" value="<?php echo isset($termoData['vigencia_fim']) ? $termoData['vigencia_fim'] : ''; ?>" required>
                <p>, podendo ser denunciado a qualquer tempo, por qualquer das três partes envolvidas, unilateralmente, mediante comunicação escrita, com antecedência mínima de 5 (cinco) dias;</p>
                <p>
                    IV- A vigência deste Termo de Compromisso de Estágio está vinculada à carga horária de Estágio do Projeto Pedagógico do Curso Superior de Tecnologia em que o (a) aluno (a) está regularmente matriculado (a);
                </p>
                <p>
                    V - Nos períodos em que a instituição de ensino adotar verificações de aprendizagem periódica ou final, a carga horária do estágio será reduzida pelo menos à metade para garantir o bom desempenho do estudante, conforme o art. 10, § 2º da Lei de Estágio;
                </p>
                <p>
                    VI- A duração do estágio, na mesma parte concedente, não poderá exceder 2 (dois) anos, exceto quando se tratar de estagiário com deficiência, conforme art. 11 da Lei de Estágio;
                </p>
                <p>
                    VII- O estágio não pode, em qualquer hipótese, se estender após a conclusão do Curso Superior de Tecnologia.
                </p>

                <h3>CLÁUSULA QUARTA</h3>
                <p>
                    Além das atribuições e responsabilidade previstas no presente Termo de Compromisso de Estágio, caberá à CONCEDENTE:
                </p>
                <ol type="I">
                    <li>Garantir ao (à) Estagiário (a) o cumprimento das exigências escolares, inclusive no que se refere ao horário escolar;</li>
                    <li>Proporcionar ao (à) Estagiário (a) atividades de aprendizagem social, profissional e cultural compatíveis com sua formação profissional;</li>
                    <li>Proporcionar ao (à) Estagiário (a) condições de treinamento prático e de relacionamento humano;</li>
                    <li>Designar um (a) Supervisor (a) ou responsável para orientar as tarefas do Estagiário;</li>
                    <li>Proporcionar à Instituição de Ensino, sempre que necessário, subsídios que possibilitem o acompanhamento, a supervisão e a avaliação parcial do Estagiário;</li>
                    <li>Entregar ao (à) Estagiário (a), por ocasião do desligamento, termo de realização do estágio, indicando de forma resumida as atividades desenvolvidas, os períodos e a avaliação de desempenho.</li>
                </ol>

                <h3>CLÁUSULA QUINTA</h3>
                <p>
                    Além das atribuições e responsabilidade previstas no presente Termo de Compromisso de Estágio, caberá ao (à) ESTAGIÁRIO (A):
                </p>
                <ol type="I">
                    <li>Estar regularmente matriculado (a) na Instituição de Ensino, em semestre compatível com a prática exigida no Estágio;</li>
                    <li>Observar as diretrizes e/ou normas internas da Concedente e os dispositivos legais aplicáveis ao estágio, bem como as orientações do Professor Responsável de Estágios e do seu Supervisor ou responsável;</li>
                    <li>Cumprir, com seriedade e responsabilidade, empenho e interesse a programação estabelecida entre a Concedente, o (a) Estagiário (a) e a Instituição de Ensino e preservar o sigilo das informações a que tiver acesso;</li>
                    <li>Elaborar e entregar à Instituição de Ensino de relatórios parciais e relatório final sobre seu estágio, na forma estabelecida por ele;</li>
                    <li>Cumprir as normas internas da Concedente, principalmente as relacionadas com o estágio e não divulgar ou transmitir, durante ou depois do período de estágio, a quem quer que seja, qualquer informação confidencial ou material que se relacione com os negócios da Concedente;</li>
                    <li>Responder pelas perdas e danos consequentes da inobservância das cláusulas constantes do presente termo;</li>
                    <li>Comunicar à Concedente, no prazo de 5 (cinco) dias, a ocorrência de qualquer uma das alternativas do inciso I da Cláusula Oitava;</li>
                    <li>Respeitar as cláusulas do Termo de Compromisso;</li>
                    <li>Encaminhar obrigatoriamente à Instituição de Ensino e à Concedente uma via do presente instrumento, devidamente assinado pelas partes;</li>
                    <li>Comunicar à Instituição de Ensino qualquer fato relevante sobre o estágio.</li>
                </ol>

                <h3>CLÁUSULA SEXTA</h3>
                <p>
                    Caberá à INSTITUIÇÃO DE ENSINO:
                </p>
                <ol type="I">
                    <li>Estabelecer critérios para a realização do Estágio Supervisionado, seu acompanhamento e avaliação bem como encaminhá-los à Concedente;</li>
                    <li>Planejar o estágio, orientar, supervisionar e avaliar o (a) Estagiário (a), parcialmente e ao final do estágio.</li>
                </ol>
                <h2>Cláusula Sétima</h2>
                <p>A Concedente se obriga a fazer o Seguro de Acidentes Pessoais ocorridos nos locais de estágio, conforme legislação vigente, de acordo com a Apólice da Seguradora nos termos do Artigo 9º Inciso IV da Lei 11.788/08.</p>
                <input type="text" class="numero_apolice" name="numero_apolice" value="<?php echo $termoData['numero_apolice']; ?>" placeholder="">
                <h3>CLÁUSULA OITAVA</h3>
                <p>
                    Constituem motivo para a rescisão automática do presente Termo de Compromisso:
                </p>
                <ol type="I">
                    <li>A conclusão, abandono ou mudança de Curso, ou trancamento de matrícula do (a) Estagiário (a);</li>
                    <li>O não cumprimento do convencionado neste Termo de Compromisso;</li>
                    <li>O abandono do estágio.</li>
                </ol>

                <h3>CLÁUSULA NONA</h3>
                <p>
                    É assegurado ao (à) Estagiário (a), sempre que o estágio tenha duração igual ou superior a um ano, período de recesso de trinta dias, a ser gozado preferencialmente durante suas férias escolares. E proporcional aos estágios inferiores a um ano. O recesso de que trata esse artigo deverá ser remunerado quando o Estagiário receber bolsa ou outra forma de contraprestação e o auxílio transportes, conforme artigo 13º, § 1º e § 2º da Lei 11.788.
                </p>

                <h3>CLÁUSULA DÉCIMA</h3>
                <p>
                    Assim, materializado e caracterizado, o presente Estágio, segundo a legislação, não acarretará vínculo empregatício de qualquer natureza entre o Estagiário e a Concedente, nos termos do que dispõem o Artigo 12º da Lei nº 11.788/08.
                </p>

                <h3>CLÁUSULA DÉCIMA PRIMEIRA</h3>
                <p>
                    As partes elegem o Foro da Comarca de Itapira-SP, com expressa renúncia de outro, por mais privilegiado que seja para dirimir qualquer questão emergente do presente Termo de Compromisso.
                </p>

                <p>
                    Por estarem de inteiro e comum acordo com as condições e dizeres deste instrumento, as partes assinam-no em 3 (três) vias de igual teor e forma, todas assinadas pelas partes, depois de lido, conferido e achado conforme em todos os seus termos.
                </p>

                <p>
                    CIDADE,_____________________ de _____ de 20_______.
                </p>

                <div style="text-align: center; margin-top: 50px;">
                    <div style="display: inline-block; vertical-align: top; width: 30%; text-align: center;">
                        <strong>(NOME DO ESTAGIÁRIO)</strong><br><br><br>

                        <hr style="border-top: 1px solid black; width: 50%; margin: 10px auto;">
                    </div>
                    <div style="display: inline-block; vertical-align: top; width: 30%; text-align: center;">
                        <strong>(CONCEDENTE DE ESTÁGIO (CEETEPS))</strong><br><br>
                        <hr style="border-top: 1px solid black; width: 50%; margin: 10px auto;">
                    </div>
                    <div style="display: inline-block; vertical-align: top; width: 30%; text-align: center;">
                        <strong>Prof. Me. Luiz Henrique Biazzoto</strong><br><br>
                        <hr style="border-top: 1px solid black; width: 50%; margin: 10px auto;">
                    </div>
                </div>


                <h2>Plano de Atividades de Estágio (PAE)</h2>
                <p>Identificação do(a) aluno(a):</p>

                <label for="matricula">Matrícula:</label>
                <input type="text" class="matricula" id="matricula" name="matricula" value="<?php echo $termoData['matricula']; ?>"><br>

                <label for="nome">Nome:</label>
                <input type="text" class="nome" id="nome" name="nome" value="<?php echo $termoData['nome']; ?>"><br>

                <label for="curso">Curso:</label>
                <input type="text" class="curso" id="curso" name="curso" value="<?php echo $termoData['curso']; ?>"><br>

                <label for="semestre">Semestre:</label>
                <input type="text" class="semestre" id="semestre" name="semestre" value="<?php echo $termoData['semestre']; ?>"><br>

                <label for="endereco">Endereço domiciliar:</label>
                <input type="text" class="endereco" id="endereco" name="endereco" value="<?php echo $termoData['endereco']; ?>"><br>

                <label for="bairro">Bairro:</label>
                <input type="text" class="bairro" id="bairro" name="bairro" value="<?php echo $termoData['bairro']; ?>"><br>

                <label for="telefone">Telefone:</label>
                <input type="text" class="telefone" id="telefone" name="telefone" value="<?php echo $termoData['telefone']; ?>"><br>

                <label for="cep">Cep:</label>
                <input type="text" class="cep" id="cep" name="cep" value="<?php echo $termoData['cep']; ?>"><br>

                <label for="cidade">Cidade:</label>
                <input type="text" class="cidade" id="cidade" name="cidade" value="<?php echo $termoData['cidade']; ?>"><br>

                <label for="estado">Estado:</label>
                <input type="text" class="estado" id="estado" name="estado" value="<?php echo $termoData['estado']; ?>"><br>

                <label for="email">Endereço eletrônico (e-mail):</label>
                <input type="email" class="email" id="email" name="email" value="<?php echo $termoData['email']; ?>"><br>

                <!-- Botão de envio -->
                <input type="submit" value="Gravar no Banco de Dados">
            </form>
        </section>
    </div>

</body>

</html>