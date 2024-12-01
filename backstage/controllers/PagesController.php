<?php

require_once ROOT_DIR . '/backstage/lib/SEO.php';

class PagesController {
    private $seo;
    private $seoConfigured = false;

    public function __construct() {
        $this->seo = new SEO();
    }

    public function getSeo() {
        if (!$this->seoConfigured) {
            throw new Exception('SEO não configurado para esta página');
        }
        return $this->seo;
    }

    protected function configureSeo($title, $description, $keywords, $image) {
        $this->seo->setTitle($title)
                  ->setDescription($description)
                  ->setKeywords($keywords)
                  ->setImage($image);
        $this->seoConfigured = true;
    }

    public function index() {
        $this->configureSeo(
            'Página Inicial',
            'Bem-vindo à nossa página inicial',
            'página inicial, home, bem-vindo',
            BASE_URL . '/assets/img/logo.png'
        );
    }

    public function about() {
        $this->configureSeo(
            'Sobre Nós',
            'Conheça mais sobre nossa empresa e história',
            'sobre nós, empresa, história',
            BASE_URL . '/assets/img/logo.png'
        );
    }

    public function contact() {
        $this->configureSeo(
            'Contato',
            'Entre em contato conosco',
            'contato, fale conosco, atendimento',
            BASE_URL . '/assets/img/logo.png'
        );
    }

    public function services() {
        $this->configureSeo(
            'Título da Página',
            'Descrição da página para SEO',
            'palavra-chave1, palavra-chave2',
            BASE_URL . '/assets/img/logo.png'
        );
    }

    public function notFound() {
        header("HTTP/1.0 404 Not Found");
        // Se precisar definir alguma variável ou lógica para a página 404
        // pode fazer aqui
    }
} 