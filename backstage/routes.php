<?php

function getRoute($url) {
    $routes = [
        '' => ['controller' => 'Pages', 'action' => 'index'],
        'about' => ['controller' => 'Pages', 'action' => 'about'],
        'contact' => ['controller' => 'Pages', 'action' => 'contact'],
        'services' => ['controller' => 'Pages', 'action' => 'services'],
        '404' => ['controller' => 'Pages', 'action' => 'notFound']
    ];

    return $routes[$url] ?? false;
} 