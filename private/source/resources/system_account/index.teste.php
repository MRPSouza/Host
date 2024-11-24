<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', __DIR__);

require_once __DIR__ . '/resources/connect.database.php';
require_once __DIR__ . '/resources/login.common.user.php';
require_once __DIR__ . '/resources/register.common.user.php';

$mensagem = '';
$mensagem_tipo = '';
$dados_anteriores = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'])) {
        if ($_POST['acao'] === 'login') {
            $login = new LOGIN();
            $resultado = $login->login($_POST['identificador'], $_POST['senha']);
            
            if (is_array($resultado)) {
                $mensagem = $resultado['message'];
                $mensagem_tipo = $resultado['status'];
                
                if ($resultado['status'] === 'success') {
                    header('Location: acesso.teste.php');
                    exit;
                }
            } else {
                $mensagem = $resultado;
                $mensagem_tipo = 'error';
            }
        } elseif ($_POST['acao'] === 'cadastro') {
            $register = new REGISTER();
            $force = isset($_POST['force_password']) && $_POST['force_password'] === 'true';
            $resultado = $register->register($_POST['nickname'], $_POST['email'], $_POST['senha'], $force);
            
            if (is_array($resultado)) {
                $mensagem = $resultado['message'];
                $mensagem_tipo = $resultado['status'];
                
                if ($resultado['status'] === 'warning') {
                    $dados_anteriores = $resultado['data'];
                }
            } else {
                $mensagem = $resultado;
                $mensagem_tipo = 'error';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login/Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            display: flex;
            gap: 40px;
            justify-content: center;
        }
        .form-container {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #0056b3;
        }
        .mensagem {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background: #e3f2fd;
            border-radius: 4px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .confirm-buttons {
            margin-top: 10px;
        }
        .confirm-buttons button {
            margin: 5px;
        }
        .message.success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
        .message.error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
    </style>
</head>
<body>
    <?php if ($mensagem): ?>
        <div class="message <?php echo $mensagem_tipo; ?>"><?php echo htmlspecialchars($mensagem); ?></div>
    <?php endif; ?>

    <div class="container">
        <!-- Formulário de Login -->
        <div class="form-container">
            <h2>Login</h2>
            <form method="POST">
                <input type="hidden" name="acao" value="login">
                
                <div class="form-group">
                    <label for="identificador">Nickname ou Email:</label>
                    <input type="text" id="identificador" name="identificador" required>
                </div>

                <div class="form-group">
                    <label for="senha-login">Senha:</label>
                    <input type="password" id="senha-login" name="senha" required>
                </div>

                <button type="submit">Entrar</button>
            </form>
        </div>

        <!-- Formulário de Cadastro -->
        <div class="form-container">
            <h2>Cadastro</h2>
            <form method="POST">
                <input type="hidden" name="acao" value="cadastro">
                
                <div class="form-group">
                    <label for="nickname">Nickname:</label>
                    <input type="text" id="nickname" name="nickname" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="senha-cadastro">Senha:</label>
                    <input type="password" id="senha-cadastro" name="senha" required>
                </div>

                <div class="confirm-buttons">
                    <button type="submit">Cadastrar</button>
                    <button type="submit" name="force_password" value="true">Cadastrar mesmo assim</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

