<?php

class BlogModule {
    public static function init() {
        // Inicialização do módulo
        // Registrar rotas, controllers, etc
    }
    
    public static function getInfo() {
        return [
            'name' => 'Blog System',
            'version' => '1.0.0',
            'description' => 'Sistema de blog com posts e categorias',
            'author' => 'Seu Nome',
            'requires' => ['users'] // Dependências de outros módulos
        ];
    }
} 