<?php
# Requisita as configurações globais
include_once '../'.$rootPrivate.'/config/config.php';

header('Access-Control-Allow-Origin: https://www.'.$trustedDomain.'');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if (
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' || 
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
) {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
}

// # Cabeçalho CSP
header("Content-Security-Policy: default-src 'none'; script-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://code.jquery.com 'sha256-3NoEtkEHDA8z02jxlEUdUqAZ34d7pY2rg3AaP2FDXDE=' 'sha256-XMv3CM8yat1em/x2bEYTzNrHS7kE+AaP2FDXDE=' 'sha256-gIjTLPeh0uQ1//c+H5XLpAfghUef3UbIR0qmR0p3ET0=' 'sha256-j9dNgTHVcc48L1ySZTrEoVzwnycrTXRNN5y/GxtJojk=' 'sha256-XMv3CM8yat1em/x2bEYTzNrHS7kE+AzJ1LUzAXTC3qY=' 'sha256-AgL4JT1YO2+/V3O1GhaA/E39XtfzGVd4Y9VhUZGLDR0=' " . BASE_URL . "; style-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com 'sha256-PtwgLPalWNZocrAtmYoZ0a6TWdZzg3zemiUcVGvoOA0=' 'sha256-qTh8VGrxK51bREFRvBE9VqeuP0KZtRw93qGpnAKKRmI=' 'sha256-umdddNzlUIleF5qpXsinViraATQUme6OtsVET2ivCHo=' 'sha256-z0WHBt+2WMiOK2g8o/EZRVoYAqxoS3GYwEa9/2CQ35o=' 'sha256-EJU7IvUJe9Q6GU5XN5Os+K844g1jNYZebkbLe7MrOMQ=' 'sha256-18GSEs+HivkI2LITdReDU50cTBVwChtq6+/L4kerp5Q=' 'sha256-adX+kppq2pnPZMh9oyh2c+qUUNazBX8tk+v1+iOC2zQ=' 'sha256-IIV79niW+hPwLQRWWBH3xp7ng8sWx9Z9/aAQdUnAM4c=' 'sha256-XCliHrvltGXb7ZJO2Qg1O6DPhZ+WpFMWmhBddwDBSuM=' 'sha256-IIV79niW+hPwLQRWWBH3xp7ng8sWx9Z9/aAQdUnAM4c=' 'sha256-vgjFaxkgq6B8pfffliq+nvNzbZZefAenf3QlD2yuoNM='; font-src 'self' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.gstatic.com data:; img-src 'self' data: https:; media-src 'self' data: https://*; connect-src 'self' * tel:; frame-ancestors 'none'; form-action 'self'; base-uri 'self'; manifest-src 'self'; upgrade-insecure-requests; block-all-mixed-content");
