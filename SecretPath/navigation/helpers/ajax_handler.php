<?php
function handleAjaxRequest($controllerInstance, $pageFile) {
    error_log('Processando requisição AJAX');
    
    // Captura os dados SEO primeiro
    if ($controllerInstance instanceof PagesController) {
        ob_start();
        $controllerInstance->getSeo();
        $seoData = ob_get_clean();
    }
    
    // Inicia a captura do conteúdo principal
    ob_start();
    echo '<main class="page-content">';
    
    // Inclui o conteúdo da página
    if (file_exists($pageFile)) {
        include $pageFile;
    } else {
        error_log('Arquivo da página não encontrado: ' . $pageFile);
        echo '<div class="error">Página não encontrada</div>';
    }
    
    echo '</main>';
    
    // Obtém o conteúdo principal
    $mainContent = ob_get_clean();
    
    // Envia os dados SEO e o conteúdo principal
    if (isset($seoData)) {
        echo $seoData;
    }
    echo $mainContent;
    
    exit();
}
