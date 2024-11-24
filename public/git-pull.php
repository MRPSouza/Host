<?php
$secret = "umbler-nao-me-pegue-2024-webhook-secreto";

// Log inicial
error_log("Webhook acionado em: " . date('Y-m-d H:i:s'));

$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'] ?? '';
if (!$signature) {
    error_log("Erro: Sem assinatura");
    die('Acesso negado - sem assinatura');
}

$hash = "sha1=" . hash_hmac('sha1', file_get_contents("php://input"), $secret);
if ($hash !== $signature) {
    error_log("Erro: Assinatura inválida");
    error_log("Hash esperado: " . $hash);
    error_log("Hash recebido: " . $signature);
    die('Assinatura inválida');
}

// Cria um arquivo de flag pra indicar que precisa atualizar
$flag_file = "/home/defaultwebsite/update_needed.flag";
file_put_contents($flag_file, date('Y-m-d H:i:s'));
error_log("Flag de atualização criada em: " . $flag_file);

echo "Flag de atualização criada!";