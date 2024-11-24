<?php
global $nonce;

# Chamadas dos scripts externos com SRI
require_once '../private/source/pages/layouts/components/html.scripts&endBody/php/external_links.php';
require_once '../private/source/pages/layouts/components/html.scripts&endBody/php/local_scripts.php';

# Renderizar scripts externos
foreach ($external_scripts as $script) {
    echo '<script nonce="' . $nonce . '" src="' . $script['url'] . '" 
        integrity="' . $script['integrity'] . '" 
        crossorigin="anonymous"></script>';
}

# Renderizar scripts locais
foreach ($local_scripts as $script) {
    echo '<script nonce="' . $nonce . '" src="' . $script['path'] . '?v=' . $script['version'] . '"></script>';
}

echo '</body></html>';
?>

