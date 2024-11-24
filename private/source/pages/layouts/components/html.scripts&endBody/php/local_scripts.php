<?php
session_start();

// Criar nonce único para cada script
$script_nonce_1 = base64_encode(random_bytes(16));
$script_nonce_2 = base64_encode(random_bytes(16));
$script_nonce_3 = base64_encode(random_bytes(16));
$script_nonce_4 = base64_encode(random_bytes(16));

// Associar cada script com seu nonce
$local_scripts = [
    'content_dynamic' => ['nonce' => $script_nonce_1],
    'resize_body' => ['nonce' => $script_nonce_2],
    'iframe_restrict' => ['nonce' => $script_nonce_3],
    'tooltip' => ['nonce' => $script_nonce_4]
]; 
// Criar variáveis únicas para cada script
$script_var_1 = base64_encode(random_bytes(16));
$script_var_2 = base64_encode(random_bytes(16));
$script_var_3 = base64_encode(random_bytes(16));
$script_var_4 = base64_encode(random_bytes(16));

$local_scripts = [
    'content_dynamic' => [
        'path' => 'content_dynamic.js',
        'version' => '1.0',
        'nonce' => $script_var_1
    ],
    'resize_body_bootstrap' => [
        'path' => 'resize_body_bootstrap.js',
        'version' => '1.0',
        'nonce' => $script_var_2
    ],
    'restriction_against_iframe' => [
        'path' => 'restriction_against_iframe.js',
        'version' => '1.0',
        'nonce' => $script_var_3
    ],
    'tooltip_popover' => [
        'path' => 'tooltip_popover.js',
        'version' => '1.0',
        'nonce' => $script_var_4
    ]
];

// Gerar hash para cada script
foreach ($local_scripts as $key => &$script) {
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/../private/source/pages/layouts/components/html.scripts&endBody/js/' . basename($script['path']);
    if (file_exists($fullPath)) {
        $content = file_get_contents($fullPath);
        $script['hash'] = generateScriptHash($content);
        $SCRIPT_HASHES[$key] = $script['hash'];
    }
} 