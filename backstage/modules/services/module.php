<?php

class ServicesModule {
    public static function init() {
        // Inicialização do módulo de serviços
        // Registrar rotas, controllers, etc
    }
    
    public static function getInfo() {
        return [
            'name' => 'Services System',
            'version' => '1.0.0',
            'description' => 'Catálogo e histórico de serviços de assistência técnica',
            'author' => 'Seu Nome',
            'requires' => ['users'] // Depende apenas do módulo base de usuários
        ];
    }
} 