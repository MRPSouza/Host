<?php
// Remover headers anteriores
header_remove("Content-Security-Policy");
header_remove("Content-Security-Policy-Report-Only");

// Todas as hashes para scripts inline
$script_hashes = [
    'sha256-jNUaLyKtUOtTVaAUziqIV9DJCNPr3ty5ZK4o7WIe1TU=',

    // Scripts do sistema
    'sha256-51S9ThZdsSdNFIWpaX5ppEm6nt4j+XHVvU1xW/LH9ng=',  // script de animação
    'sha256-k2UHtayxw6rd21AKKJSQ2u7g+C9wCNMJIaWnfSFZ5Jk=',  // outro script inline
    'sha256-5G9EkZVw7e4y1kGjf2UGMPpBSj6zhFYn8xY127Ik0ZY='   // outro script inline
];

// Todas as hashes para estilos inline
$style_hashes = [
    'sha256-lSQTU/F1/ZmmX3RPh56utZLWWyMEu9Uch9bC475QvPA=',
    'sha256-muFRSnplr5N3iEjTOjXk+DFAY53hts6pBpEoEDnY4W0=',
    'sha256-0qxSfKRkLT0a0s7bdPKt0OzTgaGpWK4YjJngQBs766A=',
    'sha256-SYJUZ32nvWNLb7A/RnSwtdSuCB+zBLAtWdp1JBTfO9w=',
    'sha256-rlx+YSsXcrPIXjRJ3Khg65SeaMFQI/6MyJvLVGaWSaA=',
    'sha256-eoYVeC34m1+4tLjM76MjpaPlMCFnZl6oAJ+wf8124Tk=',
    'sha256-iZkb53UPZKGjsK/QWVA4U2P7yf+8joKG6vfOAdY8pFk='
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
    "img-src 'self' data:; " .
    "connect-src 'self' http://localhost; " .
    "frame-ancestors 'none'; " .
    "form-action 'self'; " .
    "base-uri 'self'; " .
    "object-src 'none'";

header("Content-Security-Policy: $csp");
?>
