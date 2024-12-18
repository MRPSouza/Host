<?php
// Incluindo os arquivos necessários
require_once ROOT_DIR . '/config/config.php';
require_once ROOT_DIR . '/navigation/helpers/url_helper.php';
require_once ROOT_DIR . '/navigation/helpers/route_handler.php';
require_once ROOT_DIR . '/navigation/helpers/controller_loader.php';
require_once ROOT_DIR . '/navigation/helpers/page_loader.php';
require_once ROOT_DIR . '/navigation/helpers/error_handler.php';
require_once ROOT_DIR . '/navigation/helpers/ajax_handler.php';

try {
    // Pega e processa a URL
    $fullUrl = $_SERVER['REQUEST_URI'];
    $url = processUrl($fullUrl);

    // Verifica a rota
    $routeDetails = getRouteDetails($url);
    $controller = $routeDetails['controller'];
    $action = $routeDetails['action'];

    // Verifica se é AJAX
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
              strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

    // Carrega o controller
    $controllerInstance = loadController($controller);

    if (!method_exists($controllerInstance, $action)) {
        throw new Exception("Action não encontrada: " . $action);
    }

    // Executa a action
    $controllerInstance->$action();
    
    // Carrega a página
    $pageFile = loadPage($controllerInstance, $action);

    if ($isAjax) {
        // Garante que está usando o ajax_handler para requisições AJAX
        handleAjaxRequest($controllerInstance, $pageFile);
    } else {
        // Carregamento normal para primeira visita
        include ROOT_DIR . '/elements/html5_html,head,body.php';
        include ROOT_DIR . '/templates/header/main_header.php';
        echo '<main class="page-content">';
        include $pageFile;
        echo '</main>';
        include ROOT_DIR . '/templates/footer/main_footer.php';
        include ROOT_DIR . '/elements/html5_scripts,body,html.php';
    }

} catch (Exception $e) {
    handleError($e);
}
