<?php
require_once ROOT_DIR . '/lib/SEO.php';

class ErrorController {
    private $seo;

    public function __construct() {
        $this->seo = new SEO();
    }

    public function notFound() {
        header("HTTP/1.0 404 Not Found");
        $this->seo->setTitle('Página não encontrada')
                  ->setDescription('A página que você procura não foi encontrada')
                  ->setKeywords('404, erro, não encontrado');
    }
} 