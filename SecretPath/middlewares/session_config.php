<?php
# Requisita as configurações globais
include_once '../'.$rootPrivate.'/config/config.php';

# Configuração de sessão e proteção dos cookies
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => '.'.$trustedDomain,
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();    