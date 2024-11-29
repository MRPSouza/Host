<?php

class SchedulingModule {
    public static function init() {
        // Inicialização do módulo de agendamento
        // Registrar rotas, controllers, etc
    }
    
    public static function getInfo() {
        return [
            'name' => 'Scheduling System',
            'version' => '1.0.0',
            'description' => 'Sistema de agendamento para serviços de assistência técnica',
            'author' => 'Seu Nome',
            'requires' => ['users'] // Precisa do módulo de usuários
        ];
    }
} 