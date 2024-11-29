<?php
// Ativa exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Define o diretório raiz do projeto
    define('ROOT_DIR', dirname(__DIR__));
    define('BASE_URL', 'https://matheusrpsouza.com');

    // Pega e processa a URL
    $fullUrl = $_SERVER['REQUEST_URI'];
    $baseDir = parse_url(BASE_URL, PHP_URL_PATH) ?? '';
    $url = trim(str_replace($baseDir, '', $fullUrl), '/');
    $url = parse_url($url, PHP_URL_PATH) ?? '';
    $url = filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL);

    // Inclui o arquivo de rotas
    require_once ROOT_DIR . '/backstage/routes.php';

    // Verifica a rota
    $route = getRoute($url);

    if ($route) {
        $controller = $route['controller'];
        $action = $route['action'];
    } else {
        $controller = 'Error';
        $action = 'notFound';
    }

    // Verifica se é AJAX
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
              strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

    // Carrega o controller
    $controllerFile = ROOT_DIR . "/backstage/controllers/{$controller}Controller.php";
    if (!file_exists($controllerFile)) {
        throw new Exception("Controller não encontrado: " . $controllerFile);
    }

    require_once $controllerFile;
    $controllerClass = $controller . 'Controller';
    $controllerInstance = new $controllerClass();

    if (!method_exists($controllerInstance, $action)) {
        throw new Exception("Action não encontrada: " . $action);
    }

    // Executa a action
    $controllerInstance->$action();
    
    // Verifica o arquivo da página
    $pageFile = ROOT_DIR . '/backstage/pages/' . strtolower($action) . '.php';
    if (!file_exists($pageFile)) {
        throw new Exception("Arquivo da página não encontrado: " . $pageFile);
    }

    if ($isAjax) {
        ob_start();
        // Obtém o SEO antes do conteúdo
        $seo = ($controllerInstance instanceof PagesController) ? $controllerInstance->getSeo() : null;
        if ($seo) {
            echo '<seo-data>' . $seo->render() . '</seo-data>';
        }
        include $pageFile;
        $content = ob_get_clean();
        echo '<main>' . $content . '</main>';
        exit();
    } else {
        // Obtém o SEO do controller se for uma instância de PagesController
        
        
        include ROOT_DIR . '/backstage/pages/layout/base_html/html.head.body.php';
        include ROOT_DIR . '/backstage/pages/layout/header.php';
        echo '<main>';
        include $pageFile;
        echo '</main>';
        include ROOT_DIR . '/backstage/pages/layout/footer.php';
        include ROOT_DIR . '/backstage/pages/layout/copy.php';
        include ROOT_DIR . '/backstage/pages/layout/base_html/html.script.body.php';
    }

} catch (Exception $e) {
    error_log("Erro crítico: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}
?>