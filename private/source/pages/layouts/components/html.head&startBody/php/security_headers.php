<?php
// Remover headers anteriores
header_remove("Content-Security-Policy");
header_remove("Content-Security-Policy-Report-Only");

// Todas as hashes para scripts inline
$script_hashes = [
    'sha256-jNUaLyKtUOtTVaAUziqIV9DJCNPr3ty5ZK4o7WIe1TU=',
    'xxxx',
    'zzzz'
];

// Todas as hashes para estilos inline
$style_hashes = [
    'sha256-lSQTU/F1/ZmmX3RPh56utZLWWyMEu9Uch9bC475QvPA=',
    'yyyy',
    'zzzz'
];

// Converter arrays de hashes para string
$script_hashes_str = implode("' '", $script_hashes);
$style_hashes_str = implode("' '", $style_hashes);

// Construir a política CSP
$csp = "default-src 'self'; " .
    "script-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com " . 
       implode(" ", array_map(function($hash) { return "'$hash'"; }, $script_hashes)) . "; " .
    "style-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com '" . $style_hashes_str . "'; " .
    "font-src 'self' https://cdnjs.cloudflare.com data:; " .
    "img-src 'self' data: https: http: *; " .
    "media-src 'self' data: https://* http://*; " .
    "connect-src 'self' *; " .
    "frame-ancestors 'self'; " .
    "form-action 'self'; " .
    "base-uri 'self'; " .
    "object-src 'self'";

header("Content-Security-Policy: $csp");
?>
