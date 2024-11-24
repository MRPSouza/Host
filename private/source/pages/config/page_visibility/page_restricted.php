<?php
// Adicione no início do seu arquivo de configuração
if (
    !isset($_SERVER['HTTPS']) 
    || $_SERVER['HTTPS'] !== 'on' 
    || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] !== 'https')
) {
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

// Verifica se a constante foi definida
if (!defined('ACCESS_GRANTED')) {
    header('Location: /403.php');
    exit();
}
?>