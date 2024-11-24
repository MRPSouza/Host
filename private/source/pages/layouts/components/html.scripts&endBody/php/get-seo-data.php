<?php
header('Content-Type: application/json');

$json_file = __DIR__ . '/../private/source/pages/data/seo_pages.json';
if (file_exists($json_file)) {
    echo file_get_contents($json_file);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'File not found']);
} 