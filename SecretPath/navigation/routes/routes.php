<?php

function getRoute($url) {
    // Debug detalhado
    error_log('=== Início do Processamento de Rota ===');
    error_log('URL original: ' . $url);
    
    // Remove qualquer query string e barras extras
    $url = strtok($url, '?');
    $url = trim($url, '/');
    $url = str_replace('dashboard/Public/', '', $url);
    
    error_log('URL processada: ' . $url);
    
    // URLs personalizadas
    $routes = [
        '' => ['controller' => 'Pages', 'action' => 'inicio'],
        'inicio' => ['controller' => 'Pages', 'action' => 'inicio'],
        'sobre' => ['controller' => 'Pages', 'action' => 'sobre'],
        'about' => ['controller' => 'Pages', 'action' => 'sobre'],
        'empresa' => ['controller' => 'Pages', 'action' => 'sobre'],
        'sobre-nos' => ['controller' => 'Pages', 'action' => 'sobre'],
        'contato' => ['controller' => 'Pages', 'action' => 'contato'],
        'contact' => ['controller' => 'Pages', 'action' => 'contato'],
        'fale-conosco' => ['controller' => 'Pages', 'action' => 'contato']
    ];

    $route = $routes[$url] ?? ['controller' => 'Error', 'action' => 'notFound'];
    error_log('Rota encontrada: ' . json_encode($route));
    error_log('=== Fim do Processamento de Rota ===');
    
    return $route;
}   