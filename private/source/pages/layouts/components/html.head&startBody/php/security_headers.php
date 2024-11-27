<?php
// Remover headers anteriores
header_remove("Content-Security-Policy");
header_remove("Content-Security-Policy-Report-Only");

// Todas as hashes para scripts inline
$script_hashes = [
    'sha256-jNUaLyKtUOtTVaAUziqIV9DJCNPr3ty5ZK4o7WIe1TU=',
    'sha256-wShYhjL/WEbqxgBgWQPvW6VSsr1gGYvGj9ZPDNsVK3w=',
    'sha256-k9ISLWHcPDNxxmLk/z1Kmn5JcTnyxlLgbQgQkI+zmjg=',
    'sha256-OPlvV0PukpmbD8NgO7FYL0fXmC6HWYqI5Z4/GoE+D4w=',
    'sha256-k2UHtayxw6rd21AKKJSQ2u7g+C9wCNMJIaWnfSFZ5Jk=',
    'sha256-d6MhXPGKHgj5QgE+0nM7Ra+5XEQN570BMDXwhH627WM=',
    'sha256-5G9EkZVw7e4y1kGjf2UGMPpBSj6zhFYn8xY127Ik0ZY=',
    'sha256-ktsoVgZzBrCc7uWJHbouqdvgwtNoNKxhKFR9j81Ni0E=',
    'sha256-gUt3x4oAYKg4ROSECT8OWrXYpMRZsKZAg6rtLgTM4wE=',
    'sha256-nHvLboLpS88KYpzarZIWLE1txq204V4IRcpXTDbCrnA=',
    'sha256-o+ChJmE+JVyXAsOt12Q7OHrs5Kc8TG/xTH/iNfirUlI=',
    'sha256-eWZY4w0zMqvesfFrRCYEU3iTW4frlb2ZI60AeOOENUM=',
    'sha256-6AsBtZ8BZjTM54idQmKmH1k/GtmGe/kdGGHFu+8OMeQ=',
    'sha256-SPtUSUOBvaAMKR2dPVIzPbDYcgZYlulsIdeCRQleFRU=',
    'sha256-tMrFAE9yd4iXX5XVUqfAi50s1uPd6jzXiDidsPmUInI=',
    'sha256-idza2AcszAB2KBg0qQJycEuSrKA/LoM4amghkjHFsfg=',
    'sha256-wbBjnu4DkJ/rHWPI1bGZEfh8BvCRr4ZUPhNTQtigZzU='
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

define('DEV_MODE', true);
if(DEV_MODE){
    $csp = "default-src * 'unsafe-inline' 'unsafe-eval' data: blob:;";
    echo '<script>console.log("Alerta: Modo de desenvolvimento ativado");</script>';
}
else
{
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
    echo '<script>console.log("Alerta: Modo de produção/proteção ativado");</script>';
}

header("Content-Security-Policy: $csp");
?>
