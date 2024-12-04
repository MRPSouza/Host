<?php
// Adicione isto no início absoluto do seu arquivo PHP principal, antes de qualquer HTML ou whitespace
header("Access-Control-Allow-Origin: https://www.matheusrpsouza.com");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if (
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' || 
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
) {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
}
header("Content-Security-Policy: default-src 'none'; script-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://code.jquery.com 'sha256-3NoEtkEHDA8z02jxlEUdUqAZ34d7pY2rg3AaP2FDXDE=' 'sha256-XMv3CM8yat1em/x2bEYTzNrHS7kE+AaP2FDXDE=' 'sha256-gIjTLPeh0uQ1//c+H5XLpAfghUef3UbIR0qmR0p3ET0=' 'sha256-j9dNgTHVcc48L1ySZTrEoVzwnycrTXRNN5y/GxtJojk=' 'sha256-XMv3CM8yat1em/x2bEYTzNrHS7kE+AzJ1LUzAXTC3qY=' 'sha256-AgL4JT1YO2+/V3O1GhaA/E39XtfzGVd4Y9VhUZGLDR0=' " . BASE_URL . "; style-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com 'sha256-PtwgLPalWNZocrAtmYoZ0a6TWdZzg3zemiUcVGvoOA0=' 'sha256-qTh8VGrxK51bREFRvBE9VqeuP0KZtRw93qGpnAKKRmI=' 'sha256-umdddNzlUIleF5qpXsinViraATQUme6OtsVET2ivCHo=' 'sha256-z0WHBt+2WMiOK2g8o/EZRVoYAqxoS3GYwEa9/2CQ35o=' 'sha256-EJU7IvUJe9Q6GU5XN5Os+K844g1jNYZebkbLe7MrOMQ=' 'sha256-18GSEs+HivkI2LITdReDU50cTBVwChtq6+/L4kerp5Q=' 'sha256-adX+kppq2pnPZMh9oyh2c+qUUNazBX8tk+v1+iOC2zQ=' 'sha256-IIV79niW+hPwLQRWWBH3xp7ng8sWx9Z9/aAQdUnAM4c=' 'sha256-XCliHrvltGXb7ZJO2Qg1O6DPhZ+WpFMWmhBddwDBSuM=' 'sha256-IIV79niW+hPwLQRWWBH3xp7ng8sWx9Z9/aAQdUnAM4c='; font-src 'self' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.gstatic.com data:; img-src 'self' data: https:; media-src 'self' data: https://*; connect-src 'self' * tel:; frame-ancestors 'none'; form-action 'self'; base-uri 'self'; manifest-src 'self'; upgrade-insecure-requests; block-all-mixed-content");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php 
    // Verifica se existe uma instância de SEO e a utiliza
    if (isset($seo)) {
        echo $seo->render();
    } else {
        // SEO padrão caso não tenha sido configurado
        $defaultSeo = new SEO();
        $defaultSeo->setTitle('Meu Site')
                  ->setDescription('Descrição padrão do site')
                  ->setKeywords('site, web')
                  ->setImage(BASE_URL . '/assets/img/logo.png');
        echo $defaultSeo->render();
    }
    ?>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/assets/img/favicon.png" data-global>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>/assets/img/favicon.png" data-global>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>/assets/img/favicon.png" data-global>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>/assets/img/favicon.png" data-global>
    <link rel="manifest" href="<?php echo BASE_URL; ?>/site.webmanifest" data-global>
    
    <!-- Previne requisições automáticas de favicon -->
    <link rel="icon" href="data:," data-global>

    <!-- CSS Global -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/header.css" data-global>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/loader.css" data-global>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/copy.css" data-global>
    <!-- <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/footer.css" data-global> -->

    <?php
    // Obtém a página atual da URL
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');

    // CSS específico por página (não precisa do data-global pois são específicos)
    switch ($currentPage) {
        case 'index':
            echo '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/home.css">';
            echo '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/desktop.css">';
            break;
        case 'services':
            echo '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/services.css">';
            break;
        case 'about':
            echo '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/about.css">';
            break;
        case 'contact':
            echo '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/contact.css">';
            break;
    }
    ?>
</head>
<body>
     <!-- Scripts Globais -->
     <script src="<?= BASE_URL ?>/assets/js/loader.js" data-global></script>
    <script src="<?= BASE_URL ?>/assets/js/loaderSEO.js" data-global></script>

    <?php
    // Scripts específicos por página (não precisa do data-global pois são específicos)
    switch ($currentPage) {
        case 'index':
            echo '<script src="' . BASE_URL . '/assets/js/home.js"></script>';
            break;
        case 'services':
            echo '<script src="' . BASE_URL . '/assets/js/services.js"></script>';
            break;
        case 'about':
            echo '<script src="' . BASE_URL . '/assets/js/about.js"></script>';
            break;
        case 'contact':
            echo '<script src="' . BASE_URL . '/assets/js/phone-links.js"></script>';
            echo '<script src="' . BASE_URL . '/assets/js/contact.js"></script>';
            break;
    }
    ?>