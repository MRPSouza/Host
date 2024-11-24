<?php
require_once __DIR__ . '/resources/email.manager.php';

$token = $_GET['token'] ?? '';
$email_manager = new EMAIL_MANAGER();

if ($email_manager->verify_email($token)) {
    echo "E-mail verificado com sucesso! Você já pode fazer login.";
} else {
    echo "Link inválido ou expirado.";
} 