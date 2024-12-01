<?php

function getRoute($url) {
    // Remove qualquer query string
    $url = strtok($url, '?');
    
    // Remove barras extras
    $url = trim($url, '/');
    
    // Se estiver vazio, é a página inicial
    if (empty($url)) {
        $url = '';
    }
    
    $routes = [
        '' => ['controller' => 'Pages', 'action' => 'index'],
        'about' => ['controller' => 'Pages', 'action' => 'about'],
        'contact' => ['controller' => 'Pages', 'action' => 'contact'],
        'services' => ['controller' => 'Pages', 'action' => 'services']
    ];

    return $routes[$url] ?? null;  // Retorna null se não encontrar
} 