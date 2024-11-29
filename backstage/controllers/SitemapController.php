<?php
class SitemapController {
    public function generatePostsSitemap() {
        header('Content-Type: application/xml; charset=utf-8');
        
        // Início do XML
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Blog index
        echo $this->createUrlEntry(
            BASE_URL . '/blog',
            date('Y-m-d'),
            'daily',
            '0.9'
        );
        
        // Buscar posts do banco de dados
        $posts = $this->getAllPosts(); // Implementar este método
        
        foreach ($posts as $post) {
            echo $this->createUrlEntry(
                BASE_URL . '/blog/' . $post['slug'],
                $post['updated_at'],
                'monthly',
                '0.7'
            );
        }
        
        echo '</urlset>';
    }
    
    private function createUrlEntry($loc, $lastmod, $changefreq, $priority) {
        return "
    <url>
        <loc>{$loc}</loc>
        <lastmod>{$lastmod}</lastmod>
        <changefreq>{$changefreq}</changefreq>
        <priority>{$priority}</priority>
    </url>\n";
    }
    
    private function getAllPosts() {
        // Implementar busca de posts no banco de dados
        return [];
    }
} 