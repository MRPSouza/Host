<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug para verificar caminhos
$requestedFile = $_SERVER['REQUEST_URI'];
$fullPath = $_SERVER['DOCUMENT_ROOT'] . $requestedFile;
if (strpos($requestedFile, '.css') !== false || strpos($requestedFile, '.js') !== false) {
    echo "Arquivo solicitado: " . $requestedFile . "\n";
    echo "Caminho completo: " . $fullPath . "\n";
    echo "Arquivo existe? " . (file_exists($fullPath) ? 'Sim' : 'Não') . "\n";
    die();
}

$rootPrivate = 'SecretPath';

# Verificação do Protocolo HTTPS
include_once '../'.$rootPrivate.'/middlewares/redirect_to_https.php';

# Segurança do header
include_once '../'.$rootPrivate.'/middlewares/security_headers.php';

# Configuração exibição de erros para debug
include_once '../'.$rootPrivate.'/middlewares/debug_config.php';

# Configuração de sessão e proteção dos cookies
include_once '../'.$rootPrivate.'/middlewares/session_config.php';

# Configuração de sessão e proteção dos cookies
include_once '../'.$rootPrivate.'/middlewares/dynamic_content.php';
?>