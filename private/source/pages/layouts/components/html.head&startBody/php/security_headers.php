<?php

# Política de Segurança
include_once('../private/source/pages/config/page_visibility/page_restricted.php');  // Proibe o acesso a essa página caso o .htaccess falhe.

// Adicione no início do arquivo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Gere um único nonce para a página
$nonce = base64_encode(random_bytes(16));

// Função para gerar hash de um arquivo
function generateFileHash($filePath) {
    if (file_exists($filePath)) {
        $content = file_get_contents($filePath);
        return "'sha256-" . base64_encode(hash('sha256', $content, true)) . "'";
    }
    return null;
}

// Gerar hashes para todos os arquivos JS locais
$script_hashes = [];
foreach ($local_scripts as $script) {
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . $script['path'];
    echo "Checking: $fullPath - Exists: " . (file_exists($fullPath) ? 'Yes' : 'No') . "\n";
    $hash = generateFileHash($fullPath);
    if ($hash) {
        $script_hashes[] = $hash;
    }
}

// Gerar hashes para arquivos CSS locais
$style_hashes = [];
$css_files = [
    '/css/style.css',
    // adicione outros arquivos CSS aqui
];
foreach ($css_files as $css) {
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . $css;
    $hash = generateFileHash($fullPath);
    if ($hash) {
        $style_hashes[] = $hash;
    }
}

// Juntar todos os hashes em strings
$script_hash_string = implode(' ', $script_hashes);
$style_hash_string = implode(' ', $style_hashes);

// Adicione antes de definir o CSP
echo "<!-- Script Hashes: -->\n";
print_r($script_hashes);
echo "\n<!-- Style Hashes: -->\n";
print_r($style_hashes);

$inline_style_hashes = [
    "'sha256-lSQTU/F1/ZmmX3RPh56utZLWWyMEu9Uch9bC475QvPA='",
    "'sha256-muFRSnplr5N3iEjTOjXk+DFAY53hts6pBpEoEDnY4W0='",
    "'sha256-0qxSfKRkLT0a0s7bdPKt0OzTgaGpWK4YjJngQBs766A='",
    "'sha256-SYJUZ32nvWNLb7A/RnSwtdSuCB+zBLAtWdp1JBTfO9w='",
    "'sha256-rlx+YSsXcrPIXjRJ3Khg65SeaMFQI/6MyJvLVGaWSaA='",
    "'sha256-eoYVeC34m1+4tLjM76MjpaPlMCFnZl6oAJ+wf8124Tk='",
    "'sha256-iZkb53UPZKGjsK/QWVA4U2P7yf+8joKG6vfOAdY8pFk='"
];

$inline_script_hashes = [
    "'sha256-k2UHtayxw6rd21AKKJSQ2u7g+C9wCNMJIaWnfSFZ5Jk='",
    "'sha256-5G9EkZVw7e4y1kGjf2UGMPpBSj6zhFYn8xY127Ik0ZY='"
];

// Defina a política CSP em uma única linha
$csp_policy = "default-src 'self'; "
    . "script-src 'self' " . $script_hash_string . " " . implode(' ', $inline_script_hashes) . " "
    . "https://cdn.jsdelivr.net/ "
    . "https://code.jquery.com/; "
    . "worker-src 'self' blob: ; "
    . "style-src 'self' " . $style_hash_string . " " . implode(' ', $inline_style_hashes) . " "
    . "https://cdn.jsdelivr.net/ "
    . "https://cdnjs.cloudflare.com/ "
    . "https://fonts.googleapis.com/; "
    . "font-src 'self' "
    . "https://fonts.gstatic.com/ "
    . "https://cdnjs.cloudflare.com/; "
    . "img-src 'self' data: https:; "
    . "connect-src 'self'; "
    . "frame-ancestors 'none'; "
    . "form-action 'self'; "
    . "base-uri 'self';";

// Modifique o CSP para incluir report-only temporariamente
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
