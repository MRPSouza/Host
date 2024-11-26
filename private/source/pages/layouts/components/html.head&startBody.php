<?php
include_once('html.head&startBody/php/all-pages.php');
include_once('html.head&startBody/php/current-page.php');
include_once('html.head&startBody/php/security_headers.php');

# Início do arquivo html
echo '<!DOCTYPE html><html lang="pt-br"><head>'.

# all-pages
'<meta charset="UTF-8">'.
'<meta http-equiv="content-type" content="text/html; charset=UTF-8">'.
'<meta name="viewport" content="width=device-width, initial-scale=1" />'.
'<meta name="revisit-after" content="'.$revisit_after.'">'.
'<meta name="author" content="'.$author.'">'.
'<title id="page-title">'.$titulo_da_aba.'</title>'.
'<meta id="meta-robots" name="robots" content="'.$robots.'">'.
'<meta id="meta-googlebot" name="googlebot" content="'.$googlebot.'">'.
'<meta id="meta-googlebot-news" name="googlebot-news" content="'.$googlebot_news.'">'.
'<meta id="meta-keywords" name="keywords" content="'.$meta_palavras_chaves.'">'.
'<meta id="meta-title" name="title" content="'.$meta_titulo_da_pagina.'">'.
'<meta id="meta-description" name="description" content="'.$meta_descricao.'">'.
'<link id="canonical-link" rel="canonical" href="'.$link_canonico_da_pagina_atual.'">'.
'<link id="page-css" rel="stylesheet" href="css/'.str_replace('.php', '.css', basename($current_page)).'">'.


// <!-- Open Graph / Facebook -->
'<meta id="og-title" property="og:title" content="'.$meta_titulo_da_pagina.'">'.
'<meta id="og-description" property="og:description" content="'.$meta_descricao.'">'.
'<meta id="og-url" property="og:url" content="'.$link_canonico_da_pagina_atual.'">'.
'<meta id="og-image" property="og:image" content="'.$imagem_da_pagina_atual.'">'.
'<meta id="og-site-name" property="og:site_name" content="'.$titulo_da_aba.'">'.

// <!-- Twitter -->
'<meta id="twitter-title" name="twitter:title" content="'.$meta_titulo_da_pagina.'">'.
'<meta id="twitter-description" name="twitter:description" content="'.$meta_descricao.'">'.
'<meta id="twitter-image" name="twitter:image" content="'.$imagem_da_pagina_atual.'">'.
'<meta id="twitter-url" name="twitter:url" content="'.$link_canonico_da_pagina_atual.'">'.

// <!-- Apple -->
'<meta id="apple-title" name="apple-mobile-web-app-title" content="'.$titulo_da_aba.'">'.
'<link id="apple-image" rel="apple-touch-icon" href="'.$imagem_da_pagina_atual.'">'.
'<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">';

# Recursos externos (CSS e JS)
foreach ($external_resources as $key => $resource) {
    if ($resource['type'] === 'style') {
        echo '<link rel="stylesheet" 
              href="'.$resource['url'].'" 
              integrity="'.$resource['integrity'].'" 
              crossorigin="anonymous">';
    } else if ($resource['type'] === 'script') {
        echo '<script defer 
              src="'.$resource['url'].'" 
              integrity="'.$resource['integrity'].'" 
              crossorigin="anonymous"></script>';
    }
}

echo '<link rel="stylesheet" href="css/normalize.css" />';

?>