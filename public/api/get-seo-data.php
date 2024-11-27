<?php
header('Content-Type: application/json');

// Caminho para o arquivo JSON usando caminho do servidor
$jsonFile = __DIR__ . '/../private/source/pages/data/seo_pages.json';

if (file_exists($jsonFile)) {
    echo file_get_contents($jsonFile);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Arquivo não encontrado']);
} 