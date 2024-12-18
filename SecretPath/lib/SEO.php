<?php
class SEO {
    private $title;
    private $description;
    private $keywords;
    private $image;
    private $canonical;

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

    public function setCanonical($canonical) {
        $this->canonical = $canonical;
        return $this;
    }

    // Getters
    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getKeywords() {
        return $this->keywords;
    }

    public function getImage() {
        return $this->image;
    }

    public function getCanonical() {
        return $this->canonical;
    }

    public function render() {
        $seoData = [
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'image' => $this->image,
            'canonical' => $this->canonical
        ];
        
        return json_encode($seoData);
    }
} 