<?php
# Verificação do Protocolo HTTPS
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$isProxy = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https';

# Redireciona para https
if ($protocol !== 'https' && !$isProxy){
    $newUrl = 'https://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $newUrl);
    exit();
}
