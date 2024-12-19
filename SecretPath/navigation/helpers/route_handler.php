<?php
require_once ROOT_DIR . '/navigation/routes/routes.php';

function getRouteDetails($url) {
    error_log('getRouteDetails recebeu URL: ' . $url);
    
    $route = getRoute($url);
    if ($route) {
        error_log('Rota válida encontrada: ' . json_encode($route));
        return [
            'controller' => $route['controller'],
            'action' => $route['action']
        ];
    } else {
        error_log('Rota não encontrada, retornando 404');
        return [
            'controller' => 'Error',
            'action' => 'notFound'
        ];
    }
}
