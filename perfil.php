<?php
session_start();
include("db.php");
include("auth.php");

// Verifica se o usuário está logado
$user_data = check_login($conn);

// Define a variável $is_admin com base no papel do usuário
$is_admin = ($user_data['role'] == 'admin');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera o ID do usuário da sessão
    $user_id = $_SESSION['user_id']; // Supondo que 'user_id' seja o nome da chave que armazena o ID do usuário na sessão

    // Recupera a mensagem do formulário
    $mensagem = $_POST['mensagem'];

    // Insere a mensagem na tabela de mensagens
    $query = "INSERT INTO mensagens (user_id, mensagem) VALUES ('$user_id', '$mensagem')";
    if (mysqli_query($conn, $query)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar mensagem: " . mysqli_error($conn);
    }
}
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Flix</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/land.css">
</head>

<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="display-4">Dev Flix</h1>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="index.php">Pagina Inicial</a>
                <a class="navbar-brand" href="perfil.php">Sobre o desenvolvedor</a>
                <?php if ($is_admin) : ?>
                    <a class="navbar-brand" href="dashboard.php">Dashboard</a>
                <?php endif; ?>
                <a class="navbar-brand" href="logout.php">Sair</a>
            </nav>
        </div>
    </header>

    <body>
        <div class="container">
            <h1>Página sobre o desenvolvedor</h1>
            <img src="sua_foto.jpg" alt="Foto do desenvolvedor" class="profile-img">
            <h2>Nome: Seu Nome</h2>
            <h3>Curso: Curso de Desenvolvimento de Sistemas</h3>
            <h3>Habilidades na área de desenvolvimento de sistemas:</h3>
            <ul class="skills-list">
                <li>HTML</li>
                <li>CSS</li>
                <li>JavaScript</li>
                <li>PHP</li>
                <li>MySQL</li>
                <!-- Adicione mais habilidades conforme necessário -->
            </ul>

            <!-- Formulário para enviar mensagens -->
            <div class="message-form">
                <h3>Enviar Mensagem</h3>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <textarea name="mensagem" placeholder="Digite sua mensagem aqui..." required></textarea>
                    <br>
                    <input type="submit" value="Enviar Mensagem">
                </form>
            </div>
        </div>
    </body>

    </html>