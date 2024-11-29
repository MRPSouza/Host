<?php

class EstimatesModule {
    public static function init() {
        // Inicialização do módulo de orçamentos
        // Registrar rotas, controllers, etc
    }
    
    public static function getInfo() {
        return [
            'name' => 'Estimates System',
            'version' => '1.0.0',
            'description' => 'Sistema de orçamentos para serviços de assistência técnica',
            'author' => 'Seu Nome',
            'requires' => ['users', 'services'] // Precisa dos módulos de usuários e serviços
        ];
    }
} 