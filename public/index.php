<?php   
    # Definir o nome da página atual dinamicamente
    $current_page = basename($_SERVER['PHP_SELF'], '.php');
    $current_page = ucfirst(str_replace('-', ' ', $current_page));
    
    # Definir a visibilidade da página
    include_once('../private/source/pages/config/page_visibility/page_public.php');
    echo '<script>console.log("Definido a autorização de visibilidade da página");</script>';

    # Depois carregar o security headers que usa os nonces
    include_once '../private/source/pages/layouts/components/html.head&startBody/php/security_headers.php';
    echo '<script>console.log("Definido o security headers");</script>';

    # Por fim carregar o HTML head que também usa os nonces
    include_once '../private/source/pages/layouts/components/html.head&startBody.php';
    echo '<script>console.log("Incluído o head e o início do body");</script>';

    # Incluir o cabeçalho
    include_once '../private/source/pages/layouts/header.php';
    echo '<script>console.log("Incluído o cabeçalho");</script>';
    
    # Incluir o conteúdo dinâmico
    echo '<main id="content-dynamic">' . "\n".'<!-- Início do conteúdo dinâmico -->'."\n";
    include_once '../private/source/pages/'.$current_page.'.php';
    echo '<script>console.log("Incluído/Alterado o conteúdo dinâmico");</script>';
    echo "\n".'<!-- Fim do conteúdo dinâmico -->'."\n".'</main>';

    # Incluir o rodapé
    include_once '../private/source/pages/layouts/footer.php';
    echo '<script>console.log("Incluído o rodapé");</script>';

    # Incluir o rodapé HTML
    include_once '../private/source/pages/layouts/components/html.scripts&endBody.php';
    echo '<script>console.log("Incluído os scripts e o fechamento do body");</script>';
?>