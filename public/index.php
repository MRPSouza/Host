<?php
// Desativa a exibição de erros em produção
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// Define o diretório raiz do projeto
define('ROOT_DIR', dirname(__DIR__));
define('BASE_URL', 'https://matheusrpsouza.com');

// Obtém a URL requisitada
$url = $_GET['url'] ?? '';

// Remove 'index' se for a única coisa na URL
if ($url === 'index' || $url === 'index.php') {
    $url = '';
}

// Remove a extensão .php se existir
$url = preg_replace('/\.php$/', '', $url);

// Remove barras extras e sanitiza a URL
$url = filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL);

// Inclui o arquivo de rotas
require_once ROOT_DIR . '/backstage/routes.php';

// Verifica se existe uma rota personalizada
$route = getRoute($url);

if ($route) {
    $controller = $route['controller'];
    $action = $route['action'];
} else {
    // Divide a URL em segmentos
    $segments = explode('/', $url);
    $controller = $segments[0] ?: 'Pages';
    $action = $segments[1] ?? 'index';
}

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
            
            // Se for uma requisição AJAX, retorna apenas o conteúdo principal
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                echo '<main>';
                include ROOT_DIR . '/backstage/pages/' . strtolower($action) . '.php';
                echo '</main>';
            } else {
                // Renderiza a página completa
                include ROOT_DIR . '/backstage/pages/layout/base_html/html.head.body.php';
                include ROOT_DIR . '/backstage/pages/layout/header.php';
                echo '<main>';
                include ROOT_DIR . '/backstage/pages/' . strtolower($action) . '.php';
                echo '</main>';
                include ROOT_DIR . '/backstage/pages/layout/footer.php';
                include ROOT_DIR . '/backstage/pages/layout/copy.php';
                include ROOT_DIR . '/backstage/pages/layout/base_html/html.script.body.php';
            }
        } catch (Exception $e) {
            echo '<div style="margin: 50px; padding: 20px; border: 2px solid #f0ad4e; border-radius: 5px; background-color: #fcf8e3; color: #8a6d3b;">';
            echo '<h2>⚠️ Lembrete para o Desenvolvedor</h2>';
            echo '<p>Por favor, configure o SEO para esta página no método <strong>' . $action . '</strong> do PagesController:</p>';
            echo '<pre style="background: #f8f9fa; padding: 15px; border-radius: 4px;">';
            echo 'public function ' . $action . '() {
    $this->configureSeo(
        "Título da Página",
        "Descrição da página para SEO",
        "palavra-chave1, palavra-chave2",
        BASE_URL . "/assets/img/imagem.png"
    );
}';
            echo '</pre>';
            echo '<p>Consulte o arquivo <code>Docs/criar-uma-pagina.txt</code> para mais informações.</p>';
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