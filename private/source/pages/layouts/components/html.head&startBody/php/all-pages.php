<?php
// Arquivo único de configuração de recursos externos
$external_resources = [
    'bootstrap_css' => [
        'type' => 'style',
        'url' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        'integrity' => 'sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH'
    ],
    'popper_js' => [
        'type' => 'script',
        'url' => 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js',
        'integrity' => 'sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r'
    ],
    'bootstrap_js' => [
        'type' => 'script',
        'url' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        'integrity' => 'sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz'
    ],
    'fontawesome' => [
        'type' => 'style',
        'url' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css',
        'integrity' => 'sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=='
    ]
];

$nome_empresa = 'Matheus R P Souza';
$nome_site = '';
$author = 'Matheus R P Souza';
$revisit_after = 2;
$facebook_page = '';

if ($nome_site <> ''){$nome_site = ' - '.$nome_site;}

// Adicionar o handler para o JSON
if (isset($_GET['get_seo_data'])) {
    header('Content-Type: application/json');
    $json_file = $_SERVER['DOCUMENT_ROOT'] . '/../private/source/pages/data/seo_pages.json';
    echo file_get_contents($json_file);
    exit;
}
