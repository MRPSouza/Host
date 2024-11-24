<?php
session_start();

// Criar nonces únicos para scripts locais e externos
$nonces = [
    'bootstrap_css' => base64_encode(random_bytes(16)),
    'popper_js' => base64_encode(random_bytes(16)),
    'bootstrap_js' => base64_encode(random_bytes(16)),
    'fontawesome' => base64_encode(random_bytes(16)),
    'content_dynamic' => base64_encode(random_bytes(16)),
    'resize_body' => base64_encode(random_bytes(16)),
    'iframe_restrict' => base64_encode(random_bytes(16)),
    'tooltip' => base64_encode(random_bytes(16))
];

// Scripts locais
$local_scripts = [
    'content_dynamic' => [
        'path' => 'content_dynamic.js',
        'version' => '1.0',
        'nonce' => $nonces['content_dynamic']
    ],
    'resize_body' => [
        'path' => 'resize_body_bootstrap.js',
        'version' => '1.0',
        'nonce' => $nonces['resize_body']
    ],
    'iframe_restrict' => [
        'path' => 'restriction_against_iframe.js',
        'version' => '1.0',
        'nonce' => $nonces['iframe_restrict']
    ],
    'tooltip' => [
        'path' => 'tooltip_popover.js',
        'version' => '1.0',
        'nonce' => $nonces['tooltip']
    ]
]; 