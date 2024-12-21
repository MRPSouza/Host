<?php
include_once '../'.$rootPrivate.'/config/config.php';
// Verifica se há dados SEO disponíveis
$seoTitle = isset($seoData['title']) ? $seoData['title'] : 'Site';
$seoDescription = isset($seoData['description']) ? $seoData['description'] : '';
$seoKeywords = isset($seoData['keywords']) ? $seoData['keywords'] : '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlspecialchars($seoTitle); ?></title>
    <?php if ($seoDescription): ?>
    <meta name="description" content="<?php echo htmlspecialchars($seoDescription); ?>">
    <?php endif; ?>
    <?php if ($seoKeywords): ?>
    <meta name="keywords" content="<?php echo htmlspecialchars($seoKeywords); ?>">
    <?php endif; ?>
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/medias/favicon.ico">
    
    <!-- CSS Interno --> <!-- Lembrete: Gerar/Checar os sha512 em: https://www.srihash.org/ -->

    <link rel="stylesheet" 
          href="<?php echo BASE_URL; ?>/css/loader.css" 
          integrity="<?=$hashLoaderCSS?>" 
          crossorigin="anonymous">
    <link rel="stylesheet" 
          href="<?php echo BASE_URL; ?>/css/style.css" 
          integrity="<?=$hashStyleCSS?>" 
          crossorigin="anonymous">

</head>
<body>
    <div id="page-loader" class="loader-wrapper">
        <div class="loader">
            <div class="spinner"></div>
            <div class="loading-text">Carregando...</div>
        </div>
    </div>