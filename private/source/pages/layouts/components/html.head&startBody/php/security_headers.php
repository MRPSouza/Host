<?php

# Política de Segurança
include_once('../private/source/pages/config/page_visibility/page_restricted.php');  // Proibe o acesso a essa página caso o .htaccess falhe.

// Gere um único nonce para a página
$nonce = base64_encode(random_bytes(16));

// Defina a política CSP em uma única linha
$csp_policy = "default-src 'self'; "
    . "script-src 'self' 'nonce-{$nonce}' "
    . "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/ "
    . "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/ "
    . "https://code.jquery.com/; "
    . "style-src 'self' 'nonce-{$nonce}' "
    . "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/ "
    . "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/ "
    . "https://fonts.googleapis.com/; "
    . "font-src 'self' "
    . "https://fonts.gstatic.com/ "
    . "https://cdnjs.cloudflare.com/; "
    . "img-src 'self' data:; "
    . "connect-src 'self'; "
    . "frame-ancestors 'none'; "
    . "form-action 'self'; "
    . "base-uri 'self'; "
    . "upgrade-insecure-requests;";

// Defina o cabeçalho CSP
header("Content-Security-Policy: $csp_policy");

// Proteger contra XSS
header("X-XSS-Protection: 1; mode=block");

// Proteger contra Clickjacking
header("X-Frame-Options: DENY");

// Proteger contra MIME Sniffing
header("X-Content-Type-Options: nosniff");

// Forçar HTTPS
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");

// Prevenir vazamento de informações de referência
header("Referrer-Policy: strict-origin-when-cross-origin");

// Desabilitar cache para conteúdo sensível
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// Desabilitar recursos de rastreamento do navegador
header("Permissions-Policy: accelerometer=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=()");

// Limpar cookies de sessão após o fechamento do navegador
ini_set('session.cookie_lifetime', 0);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Strict');

// Configurar o PHP para relatar erros sem exibir informações sensíveis
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

?>
