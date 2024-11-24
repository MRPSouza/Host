<?php
// Definir origens permitidas
$allowed_domains = [
    'cdn.jsdelivr.net',
    'cdnjs.cloudflare.com',
    '*.cloudflare.com'
];

// Construir CSP
$csp_domains = implode(' https://', array_merge([''], $allowed_domains));

$csp = "default-src 'self'; " .
    "script-src 'self'" . $csp_domains . "; " .
    "style-src 'self'" . $csp_domains . "; " .
    "font-src 'self' https://cdnjs.cloudflare.com data:; " .
    "img-src 'self' data:;";

header("Content-Security-Policy: " . $csp);
?>
