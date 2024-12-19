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

// # Cabeçalho CSP > Altere a hash do LoaderJS em config/config.php

header("Content-Security-Policy: default-src 'none'; script-src 'strict-dynamic' '".$hashLoaderJS."'; style-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com 'sha512-uaWmN+343KGAqsz4Dd989q/V9RaeezsjNJwS+FgIFWUjbAcVdWXlsfaIm9E7HHIKaB5gtSZWPcHq5sy5kVTXtQ==' 'sha512-+PpZPxGht9g30mAu3bWYo6A9hL/hPWkeuu7JMb1+15fjlENKs1yzluGRBfDsGAfLW26Gcc1P1pa9y0xf6XCpaA==' 'sha512-zVkc1+vgdzqKI6O7OLUIiaT/wskDBg83oW/pSF9uRF/YMY9oPhd2+Ud2uG4zlB2qAus4lIQBN/t3svQtZpK7BA==' 'sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==' 'sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==' 'sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=='; font-src 'self' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.gstatic.com data:; img-src 'self' data: https:; media-src 'self' data: https://*; connect-src 'self' * tel:; frame-ancestors 'none'; form-action 'self'; base-uri 'self'; manifest-src 'self'; upgrade-insecure-requests; block-all-mixed-content");