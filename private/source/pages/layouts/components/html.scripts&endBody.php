<?php
# Chamadas dos scripts externos com SRI
require_once '../private/source/pages/layouts/components/html.scripts&endBody/php/external_links.php';
require_once '../private/source/pages/layouts/components/html.scripts&endBody/php/local_scripts.php';

# Renderizar scripts externos (já está sendo feito no external_links.php)

# Renderizar scripts locais
foreach ($local_scripts as $script) {
    echo '<script src="' . $script['path'] . '?v=' . $script['version'] . '"></script>';
}

# Fim do arquivo html
echo '</body></html>';
?>

