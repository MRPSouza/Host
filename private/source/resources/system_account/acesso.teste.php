<?php
require_once __DIR__ . '/resources/login.common.user.php';

$login = new LOGIN();
$auth = $login->check_auth();

if ($auth) {
    echo "<h2>Status da Autenticação</h2>";
    echo "<p>Usuário autenticado!</p>";
    echo "<p>ID do usuário: " . htmlspecialchars($auth['id']) . "</p>";
    echo "<p>Nome de usuário: " . htmlspecialchars($auth['username']) . "</p>";
    
    echo "<h3>Cookies ativos:</h3>";
    echo "<pre>";
    foreach ($_COOKIE as $name => $value) {
        if (strpos($name, 'MCAUTH_') === 0) {
            echo htmlspecialchars($name) . ": [valor protegido]\n";
        }
    }
    echo "</pre>";
    
    // Formulário de logout
    echo "<form method='post'>";
    echo "<input type='hidden' name='action' value='logout'>";
    echo "<button type='submit'>Fazer Logout</button>";
    echo "</form>";
} else {
    echo "<p>Usuário não autenticado!</p>";
    echo "<p><a href='index.teste.php'>Ir para página de login</a></p>";
}

// Processa o logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'logout') {
    $login->logout();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Autenticação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        h2, h3 {
            color: #333;
        }
        
        pre {
            background-color: #fff;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        
        button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        
        button:hover {
            background-color: #c82333;
        }
        
        a {
            color: #007bff;
            text-decoration: none;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <!-- O conteúdo PHP será inserido aqui -->
</body>
</html>
