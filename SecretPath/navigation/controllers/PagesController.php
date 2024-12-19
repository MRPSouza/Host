<?php

require_once ROOT_DIR . '/lib/SEO.php';

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
        
        // Retorna dados em formato JSON dentro de uma tag seo-data
        echo '<seo-data>' . $this->seo->render() . '</seo-data>';
    }

    protected function configureSeo($title, $description, $keywords, $image = null, $canonical = null) {
        $this->seo->setTitle($title)
                  ->setDescription($description)
                  ->setKeywords($keywords);
        
        if ($image) {
            $this->seo->setImage($image);
        }
        
        if ($canonical) {
            $this->seo->setCanonical($canonical);
        }
        
        $this->seoConfigured = true;
    }

    public function inicio() {
        $this->configureSeo(
            'Página Inicial - Gear Shop',
            'Bem-vindo à Gear Shop - Sua loja de equipamentos',
            'gear shop, equipamentos, loja'
        );
        return true;
    }

    public function sobre() {
        $this->configureSeo(
            'Sobre Nós - Gear Shop',
            'Conheça mais sobre a Gear Shop e nossa história',
            'sobre nós, história, gear shop'
        );
        return true;
    }

    public function contato() {
        $this->configureSeo(
            'Contato - Gear Shop',
            'Entre em contato com a Gear Shop',
            'contato, fale conosco, gear shop'
        );
        return true;
    }

    public function services() {
        $this->configureSeo(
            'Título da Página',
            'Descrição da página para SEO',
            'palavra-chave1, palavra-chave2',
            BASE_URL . '/medias/img/logo.png'
        );
    }

    public function notFound() {
        header("HTTP/1.0 404 Not Found");
        // Se precisar definir alguma variável ou lógica para a página 404
        // pode fazer aqui
    }
} 