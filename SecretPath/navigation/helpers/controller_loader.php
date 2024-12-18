<?php
function loadController($controller) {
    $controllerFile = ROOT_DIR . "/navigation/controllers/{$controller}Controller.php";
    if (!file_exists($controllerFile)) {
        throw new Exception("Controller não encontrado: " . $controllerFile);
    }
    require_once $controllerFile;
    $controllerClass = $controller . 'Controller';
    return new $controllerClass();
}
