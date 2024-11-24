<?php
global $nonce;

# Chamadas dos scripts externos com SRI
require_once $_SERVER['DOCUMENT_ROOT'] . '/../private/source/pages/layouts/components/html.scripts&endBody/php/external_links.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../private/source/pages/layouts/components/html.scripts&endBody/php/local_scripts.php';

# Renderizar scripts externos
foreach ($external_scripts as $script) {
    echo '<script nonce="' . $_SESSION['nonce'] . '" src="' . $script['url'] . '" 
        integrity="' . $script['integrity'] . '" 
        crossorigin="anonymous"></script>';
}

# Renderizar scripts locais
foreach ($local_scripts as $key => $script) {
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/../private/source/pages/layouts/components/html.scripts&endBody/js/' . basename($script['path']);
    if (file_exists($fullPath)) {
        $content = file_get_contents($fullPath);
        echo "<script nonce='{$script['nonce']}'>" . $content . "</script>";
    } else {
        error_log("Arquivo não encontrado: " . $fullPath);
    }
}

echo '</body></html>';
?>

