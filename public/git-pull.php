<?php
$secret = "umbler-nao-me-pegue-2024-webhook-secreto";

// Log inicial
error_log("Webhook acionado em: " . date('Y-m-d H:i:s'));
error_log("Headers recebidos: " . print_r($_SERVER, true));
error_log("Payload recebido: " . file_get_contents("php://input"));

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

// Executa o pull
error_log("Iniciando pull...");
chdir('/home/defaultwebsite');
$output = shell_exec('git pull origin main 2>&1');
error_log("Resultado do pull: " . $output);

echo "Pull executado com sucesso!"; 