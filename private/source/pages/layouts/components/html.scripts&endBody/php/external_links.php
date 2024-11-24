<?php
// Scripts e recursos externos
$external_resources = [
    'bootstrap_css' => [
        'type' => 'style',
        'url' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        'nonce' => $nonces['bootstrap_css']
    ],
    'popper_js' => [
        'type' => 'script',
        'url' => 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js',
        'nonce' => $nonces['popper_js']
    ],
    'bootstrap_js' => [
        'type' => 'script',
        'url' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        'nonce' => $nonces['bootstrap_js']
    ],
    'fontawesome' => [
        'type' => 'style',
        'url' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css',
        'nonce' => $nonces['fontawesome']
    ]
];
?>