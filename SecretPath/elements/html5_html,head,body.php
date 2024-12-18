<?php
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
    
    <!-- CSS Crítico - carrega primeiro -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/critical.css">
    
    <!-- JavaScript Crítico - carrega primeiro -->
    <script src="<?php echo BASE_URL; ?>/js/critical.js"></script>
    
    <!-- SEO Tags -->
    <title><?php echo htmlspecialchars($seoTitle); ?></title>
    <?php if ($seoDescription): ?>
    <meta name="description" content="<?php echo htmlspecialchars($seoDescription); ?>">
    <?php endif; ?>
    <?php if ($seoKeywords): ?>
    <meta name="keywords" content="<?php echo htmlspecialchars($seoKeywords); ?>">
    <?php endif; ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/medias/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style_main_header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style_main_footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/loader.css">
</head>
<body>
    <!-- Loader crítico -->
    <div class="critical-loader"></div>
    
    <!-- Seu loader normal -->
    <?php include ROOT_DIR . '/templates/loader/loader.php'; ?>
</body>
</html>