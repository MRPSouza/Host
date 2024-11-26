<?php
// Configurar diretório de sessão
ini_set('session.save_path', '/home/defaultwebsite/tmp/session');

// Criar diretório se não existir
if (!is_dir(session_save_path())) {
    mkdir(session_save_path(), 0777, true);
}

// Iniciar sessão
session_start();

// Validações de segurança
header('Content-Type: text/html; charset=utf-8');

$allowed_pages = ['index', '404', '500', 'politica_de_uso', 'politica_de_privacidade', 'politica_de_cookies', 'cadastro'];
$page = isset($_GET['page']) ? $_GET['page'] : '';

if (!in_array($page, $allowed_pages)) {
    http_response_code(404);
    exit('Página não encontrada');
}

// Carrega a página do diretório private
$file_path = "../private/source/pages/{$page}.php";
if (file_exists($file_path)) {
    include $file_path;
} else {
    http_response_code(404);
    exit('Arquivo não encontrado');
} 