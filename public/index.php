<?php
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

// Remove 'index' se for a única coisa na URL
if ($url === 'index' || $url === 'index.php') {
    debug("URL era 'index', removendo...");
    $url = '';
}

// Inclui o arquivo de rotas
require_once ROOT_DIR . '/backstage/routes.php';

// Verifica a rota antes de qualquer processamento
$route = getRoute($url);
debug("Rota encontrada para", ['url' => $url, 'route' => $route]);

if ($route) {
    $controller = $route['controller'];
    $action = $route['action'];
} else {
    debug("Rota não encontrada, redirecionando para 404");
    $controller = 'Error';
    $action = 'notFound';
}

debug("Controller final", $controller);
debug("Action final", $action);

// Carrega o controller apropriado
$controllerFile = ROOT_DIR . "/backstage/controllers/{$controller}Controller.php";
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = $controller . 'Controller';
    $controllerInstance = new $controllerClass();
    
    if (method_exists($controllerInstance, $action)) {
        try {
            // Configura o SEO primeiro
            $controllerInstance->$action();
            $seo = $controllerInstance->getSeo();
            
            // Verifica se o arquivo da página existe antes de tentar incluí-lo
            $pageFile = ROOT_DIR . '/backstage/pages/' . strtolower($action) . '.php';
            if (!file_exists($pageFile)) {
                throw new Exception("Arquivo da página não encontrado: " . $pageFile);
            }
            
            // Debug antes do if para verificar headers
            debug("=== DEBUG PRE-AJAX CHECK ===");
            debug("Headers recebidos", getallheaders());
            debug("HTTP_X_REQUESTED_WITH está definido?", isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? 'SIM' : 'NÃO');
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                debug("Valor de HTTP_X_REQUESTED_WITH", $_SERVER['HTTP_X_REQUESTED_WITH']);
            }
            debug("=== FIM DEBUG PRE-AJAX ===");

            if($isAjax) {
                debug("=== PROCESSANDO REQUISIÇÃO AJAX ===");
                // Debug detalhado
                debug("URL completa", $_SERVER['REQUEST_URI']);
                debug("URL processada", $url);
                debug("Segments", $segments);
                debug("Controller", $controller);
                debug("Action", $action);
                debug("Page File", $pageFile);
                debug("Route", print_r($route, true));
                debug("SERVER", print_r($_SERVER, true));
                debug("=== FIM DEBUG ===");
                
                // Força a saída do debug também na resposta
                header('Content-Type: text/html');
                echo "<!-- Debug Info:\n";
                echo "URL: {$url}\n";
                echo "Controller: {$controller}\n";
                echo "Action: {$action}\n";
                echo "Page File: {$pageFile}\n";
                echo "-->\n";
                
                // Adiciona log para debug
                error_log("Requisição AJAX - URL: {$url}, Controller: {$controller}, Action: {$action}");
                error_log("Arquivo da página: {$pageFile}");
                
                // Verifica se é uma requisição POST
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    error_log("Dados POST: " . print_r($_POST, true));
                }
                
                echo '<main>';
                include $pageFile;
                echo '</main>';
                exit(); // Garante que nada mais será executado após o conteúdo AJAX
            } else {
                error_log("=== PROCESSANDO REQUISIÇÃO NORMAL ===");
                error_log("NÃO ENTROU NO IF DO AJAX");
                // Renderiza a página completa
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
            // Adiciona log de erro para debug
            error_log("Erro ao carregar página: " . $e->getMessage());
            echo '<div style="margin: 50px; padding: 20px; border: 2px solid #dc3545; border-radius: 5px; background-color: #f8d7da; color: #721c24;">';
            echo '<h2>❌ Erro ao carregar a página</h2>';
            echo '<p>' . $e->getMessage() . '</p>';
            echo '<p>Controller: ' . $controller . ', Action: ' . $action . '</p>';
            echo '</div>';
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        include ROOT_DIR . '/backstage/pages/404.php';
    }
} else {
    header("HTTP/1.0 404 Not Found");
    require_once ROOT_DIR . '/backstage/controllers/ErrorController.php';
    $errorController = new ErrorController();
    $errorController->notFound($url);
    include ROOT_DIR . '/backstage/pages/layout/copy.php';
    include ROOT_DIR . '/backstage/pages/layout/base_html/html.script.body.php';
}
?>