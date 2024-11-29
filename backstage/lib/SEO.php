<?php
class SEO {
    private $title = '';
    private $description = '';
    private $keywords = '';
    private $author = '';
    private $image = '';
    private $url = '';
    private $type = 'website';
    private $robots = 'index, follow';
    private $canonical = '';
    private $language = 'pt-BR';

    public function __construct($title = '', $description = '') {
        $this->title = $title;
        $this->description = $description;
        $this->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->canonical = $this->url;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setRobots($robots) {
        $this->robots = $robots;
        return $this;
    }

    public function setCanonical($canonical) {
        $this->canonical = $canonical;
        return $this;
    }

    public function render() {
        $tags = [];

        // Meta tags básicas
        $tags[] = "<meta charset='UTF-8'>";
        $tags[] = "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $tags[] = "<meta http-equiv='X-UA-Compatible' content='ie=edge'>";
        $tags[] = "<title>{$this->title}</title>";
        
        // Meta tags SEO
        if ($this->description) {
            $tags[] = "<meta name='description' content='{$this->description}'>";
        }
        if ($this->keywords) {
            $tags[] = "<meta name='keywords' content='{$this->keywords}'>";
        }
        $tags[] = "<meta name='robots' content='{$this->robots}'>";
        $tags[] = "<link rel='canonical' href='{$this->canonical}'>";
        $tags[] = "<meta name='language' content='{$this->language}'>";

        // Open Graph tags
        $tags[] = "<meta property='og:title' content='{$this->title}'>";
        if ($this->description) {
            $tags[] = "<meta property='og:description' content='{$this->description}'>";
        }
        $tags[] = "<meta property='og:url' content='{$this->url}'>";
        $tags[] = "<meta property='og:type' content='{$this->type}'>";
        if ($this->image) {
            $tags[] = "<meta property='og:image' content='{$this->image}'>";
        }

        // Twitter Card tags
        $tags[] = "<meta name='twitter:card' content='summary_large_image'>";
        $tags[] = "<meta name='twitter:title' content='{$this->title}'>";
        if ($this->description) {
            $tags[] = "<meta name='twitter:description' content='{$this->description}'>";
        }
        if ($this->image) {
            $tags[] = "<meta name='twitter:image' content='{$this->image}'>";
        }

        return implode("\n    ", $tags);
    }
} 