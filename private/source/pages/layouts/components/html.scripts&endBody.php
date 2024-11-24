<?php
global $nonce;

# Chamadas dos scripts externos com SRI
require_once $_SERVER['DOCUMENT_ROOT'] . '/../private/source/pages/layouts/components/html.scripts&endBody/php/external_links.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../private/source/pages/layouts/components/html.scripts&endBody/php/local_scripts.php';

# Renderizar scripts externos
foreach ($external_scripts as $script) {
    echo '<script nonce="' . $nonce . '" src="' . $script['url'] . '" 
        integrity="' . $script['integrity'] . '" 
        crossorigin="anonymous"></script>';
}

# Renderizar scripts locais - Usando caminho absoluto
foreach ($local_scripts as $script) {
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/../private/source/pages/js/' . basename($script['path']);
    if (file_exists($fullPath)) {
        $content = file_get_contents($fullPath);
        echo '<script nonce="' . $nonce . '">' . $content . '</script>';
    } else {
        error_log("Arquivo não encontrado: " . $fullPath);  // Log para debug
    }
}

echo '</body></html>';
?>

