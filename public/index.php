<?php   
    # Definir o nome da página atual dinamicamente
    $current_page = basename($_SERVER['PHP_SELF'], '.php');
    $current_page = ucfirst(str_replace('-', ' ', $current_page));
    
    # Definir a visibilidade da página
    include_once('../private/source/pages/config/page_visibility/page_public.php');

    # Depois carregar o security headers que usa os nonces
    include_once '../private/source/pages/layouts/components/html.head&startBody/php/security_headers.php';

    # Por fim carregar o HTML head que também usa os nonces
    include_once '../private/source/pages/layouts/components/html.head&startBody.php';

    # Incluir o cabeçalho
    include_once '../private/source/pages/layouts/header.php';
    
    # Incluir o conteúdo dinâmico
    echo '<main id="content-dynamic">' . "\n".'<!-- Início do conteúdo dinâmico -->'."\n";
    include_once '../private/source/pages/'.$current_page.'.php';
    echo "\n".'<!-- Fim do conteúdo dinâmico -->'."\n".'</main>';

    # Incluir o rodapé
    include_once '../private/source/pages/layouts/footer.php';

    # Incluir o rodapé HTML
    include_once '../private/source/pages/layouts/components/html.scripts&endBody.php';
?>