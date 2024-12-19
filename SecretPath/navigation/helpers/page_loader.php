<?php
function loadPage($controllerInstance, $action) {
    $pageFile = ROOT_DIR . '/pages/static/' . strtolower($action) . '.php';
    if (!file_exists($pageFile)) {
        header("HTTP/1.0 404 Not Found");
        $pageFile = ROOT_DIR . '/pages/static/error/404.php';
        if (!file_exists($pageFile)) {
            throw new Exception("Arquivo da página 404 não encontrado");
        }
    }
    return $pageFile;
}
