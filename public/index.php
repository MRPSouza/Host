<?php
// Ativa exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Função de debug melhorada
function debug($message, $data = null) {
    // Log para PHP
    error_log($message . ($data ? ': ' . print_r($data, true) : ''));
    
    // Só exibe console.log se não for uma requisição AJAX
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
        if (is_array($data)) {
            $data = json_encode($data);
        }
        echo "<script>console.log('" . addslashes($message) . "'" . 
             ($data ? ", " . json_encode($data) : "") . ");</script>\n";
    }
}

try {
    // Debug inicial
    debug("=== INICIANDO INDEX.PHP ===");

    // Define o diretório raiz do projeto
    define('ROOT_DIR', dirname(__DIR__));
    define('BASE_URL', 'https://matheusrpsouza.com');

    // Pega e processa a URL
    $url = $_GET['url'] ?? '';
    $url = filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL);
    debug("URL original", $_SERVER['REQUEST_URI']);
    debug("URL processada", $url);

    // Inclui o arquivo de rotas
    require_once ROOT_DIR . '/backstage/routes.php';

    // Verifica a rota
    $route = getRoute($url);
    debug("Rota encontrada", $route);

    if ($route) {
        $controller = $route['controller'];
        $action = $route['action'];
    } else {
        debug("Rota não encontrada para URL", $url);
        throw new Exception("Rota não encontrada para: " . $url);
    }

    // Verifica se é AJAX
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
              strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    debug("Requisição AJAX?", $isAjax);

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
        debug("Renderizando conteúdo AJAX");
        
        // Desativa a saída de buffer
        ob_start();
        
        // Inclui apenas o conteúdo da página
        include $pageFile;
        
        // Pega o conteúdo do buffer
        $content = ob_get_clean();
        
        // Retorna apenas o conteúdo principal dentro da tag main
        echo '<main>' . $content . '</main>';
        
        // Encerra a execução aqui
        exit();
    } else {
        debug("Renderizando página completa");
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
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
}
?>