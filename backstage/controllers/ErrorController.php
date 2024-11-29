<?php
require_once ROOT_DIR . '/backstage/lib/SEO.php';

class ErrorController {
    private $seo;

    public function __construct() {
        $this->seo = new SEO();
    }

    public function getSeo() {
        return $this->seo;
    }

    public function notFound($requestedUrl = '') {
        $this->seo->setTitle('Página não encontrada | 404')
                  ->setDescription('A página solicitada não foi encontrada')
                  ->setKeywords('404, erro, página não encontrada')
                  ->setImage(BASE_URL . '/assets/img/logo.png');

        // Passa a URL solicitada para a view
        $url = !empty($requestedUrl) ? $requestedUrl : $_SERVER['REQUEST_URI'];
        include ROOT_DIR . '/backstage/pages/404.php';
    }
} 