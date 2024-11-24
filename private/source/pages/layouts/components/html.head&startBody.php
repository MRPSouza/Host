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
'<meta name="author" content="'.$author.'">';

# Recursos externos (CSS e JS)
foreach ($external_resources as $key => $resource) {
    if ($resource['type'] === 'style') {
        echo '<link rel="stylesheet" 
              href="'.$resource['url'].'" 
              integrity="'.$resource['integrity'].'" 
              nonce="'.$nonces[$key].'"
              crossorigin="anonymous">';
    } else if ($resource['type'] === 'script') {
        echo '<script defer 
              src="'.$resource['url'].'" 
              integrity="'.$resource['integrity'].'" 
              nonce="'.$nonces[$key].'"
              crossorigin="anonymous"></script>';
    }
}

echo '<link rel="stylesheet" href="css/normalize.css" />';

# Resto das meta tags...

?>