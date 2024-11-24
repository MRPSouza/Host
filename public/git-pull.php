<?php
$secret = "umbler-nao-me-pegue-2024-webhook-secreto";

$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'] ?? '';
if (!$signature) {
    die('Acesso negado');
}

$hash = "sha1=" . hash_hmac('sha1', file_get_contents("php://input"), $secret);
if ($hash !== $signature) {
    die('Assinatura inválida');
}

// Loga tudo pra gente poder debugar se der merda
error_log("Webhook acionado: " . date('Y-m-d H:i:s'));

// Executa o pull
chdir('/home/defaultwebsite');
$output = shell_exec('git pull origin main 2>&1');
error_log("Resultado do pull: " . $output);

echo "Pull executado!"; 