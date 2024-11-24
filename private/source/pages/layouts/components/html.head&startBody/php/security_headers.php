<?php

# Política de Segurança
// Comentar temporariamente para teste
// include_once('../private/source/pages/config/page_visibility/page_restricted.php');

// Antes do include
error_log("Tentando incluir page_restricted.php");
include_once('../private/source/pages/config/page_visibility/page_restricted.php');
error_log("Include realizado com sucesso");

// Adicione no início do arquivo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Gerar um único nonce por sessão
if (!isset($_SESSION['csp_nonce'])) {
    $_SESSION['csp_nonce'] = base64_encode(random_bytes(16));
}
$nonce = $_SESSION['csp_nonce'];

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
// echo "<!-- Script Hashes: -->\n";
// print_r($script_hashes);
// echo "\n<!-- Style Hashes: -->\n";
// print_r($style_hashes);

// Definir todos os hashes de script em um único array, sem duplicatas
$script_hashes = [
    "'sha256-k2UHtayxw6rd21AKKJSQ2u7g+C9wCNMJIaWnfSFZ5Jk='",
    "'sha256-5G9EkZVw7e4y1kGjf2UGMPpBSj6zhFYn8xY127Ik0ZY='",
    "'sha256-wDIFZ0qYjE60YyzUhO06kA6OYdPSOhKirRnTyS3j11Y='",
    "'sha256-90ZdoC9kHId7WVKDYd0K5xvj/8aZ6oM9udkLtBGNx7Q='",
    "'sha256-bdvmA4hVgUddpVZwV8uXYAu2k8BHz1VWRzH8ho+6np0='",
    "'sha256-NV330IZQnSrhvXKo1Kh3LGeVmXKxN9pg2Z3JLD3h4Gw='",
    "'sha256-vwpS6YH5eqNzzhCNBNu0fim2y+q7qFKaRs7+n/oqlP0='",
    "'sha256-SfsaUXDtEB2wbEB1qNV7Wwmg1s5a0sikns9gPLA8DBc='",
    "'sha256-cp9x4kfEZ7tgGslqq2xjqzqLh9oOABvOmU4KF5WDMH0='",
    "'sha256-67BSwurHsxG2bb4oXUw0Rb7vMq4Yh2O98S22xvU7SsI='"
];

// Remover duplicatas do array de scripts
$script_hashes = array_unique($script_hashes);

// Definir hashes de estilo
$style_hashes = [
    "'sha256-lSQTU/F1/ZmmX3RPh56utZLWWyMEu9Uch9bC475QvPA='",
    "'sha256-muFRSnplr5N3iEjTOjXk+DFAY53hts6pBpEoEDnY4W0='",
    "'sha256-0qxSfKRkLT0a0s7bdPKt0OzTgaGpWK4YjJngQBs766A='",
    "'sha256-SYJUZ32nvWNLb7A/RnSwtdSuCB+zBLAtWdp1JBTfO9w='",
    "'sha256-rlx+YSsXcrPIXjRJ3Khg65SeaMFQI/6MyJvLVGaWSaA='",
    "'sha256-eoYVeC34m1+4tLjM76MjpaPlMCFnZl6oAJ+wf8124Tk='",
    "'sha256-iZkb53UPZKGjsK/QWVA4U2P7yf+8joKG6vfOAdY8pFk='"
];

// Construir a lista de nonces para o CSP
$script_nonces = array_map(function($script) {
    return "'nonce-{$script['nonce']}'";
}, $local_scripts);

// Construir a lista de hashes para o CSP
$all_script_hashes = array_merge($SCRIPT_HASHES, $EXTERNAL_SCRIPT_HASHES);

// Hash para cada script específico
$login_validation_hash = generateScriptHash($login_validation_content);
$form_handler_hash = generateScriptHash($form_handler_content);
$user_interface_hash = generateScriptHash($user_interface_content);
$data_processor_hash = generateScriptHash($data_processor_content);
// ... e assim por diante

// Criar variáveis únicas para cada script
$script_var_1 = base64_encode(random_bytes(16));
$script_var_2 = base64_encode(random_bytes(16));
$script_var_3 = base64_encode(random_bytes(16));
$script_var_4 = base64_encode(random_bytes(16));

// Então usar essas variáveis no CSP
$csp_policy = "default-src 'self'; script-src 'self' " .
    "'nonce-{$script_var_1}' " .
    "'nonce-{$script_var_2}' " .
    "'nonce-{$script_var_3}' " .
    "'nonce-{$script_var_4}'";

header("Content-Security-Policy: $csp_policy");

// Proteger contra XSS
header("X-XSS-Protection: 1; mode=block");

// Proteger contra Clickjacking
header("X-Frame-Options: DENY");

// Proteger contra MIME Sniffing
header("X-Content-Type-Options: nosniff");

// Apenas envie HSTS se já estiver em HTTPS
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
}

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

if ($_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
}

// Para debug, vamos logar a política completa
error_log("CSP Policy: " . $csp_policy);

?>
