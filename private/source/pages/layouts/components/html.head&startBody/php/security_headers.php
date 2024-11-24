<?php
// Construir string de nonces para CSP
$nonce_string = "";
foreach ($nonces as $nonce) {
    $nonce_string .= "'nonce-{$nonce}' ";
}

$csp = "default-src 'self'; " .
    "script-src 'self' 'strict-dynamic' " . 
    $nonce_string .
    "https://cdn.jsdelivr.net " .
    "https://cdnjs.cloudflare.com " .
    "https://*.cloudflare.com; " .
    "style-src 'self' 'unsafe-inline' " .
    "https://cdn.jsdelivr.net " .
    "https://cdnjs.cloudflare.com; " .
    "font-src 'self' " .
    "https://cdnjs.cloudflare.com; " .
    "img-src 'self' data: https:; " .
    "connect-src 'self'";

header("Content-Security-Policy: " . $csp);
?>
