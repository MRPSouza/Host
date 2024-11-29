<?php

class UsersModule {
    public static function init() {
        // Inicialização do módulo de usuários
        // Registrar rotas, controllers, etc
    }
    
    public static function getInfo() {
        return [
            'name' => 'User Management',
            'version' => '1.0.0',
            'description' => 'Sistema base de gerenciamento de usuários e autenticação',
            'author' => 'Seu Nome',
            'requires' => [] // Módulo base, sem dependências
        ];
    }
} 