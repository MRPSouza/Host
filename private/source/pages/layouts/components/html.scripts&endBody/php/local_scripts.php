<?php
session_start();

// Scripts locais
$local_scripts = [
    'content_dynamic' => [
        'path' => '../private/source/pages/layouts/components/html.scripts&endBody/js/content_dynamic.js',
        'version' => '1.0'
    ],
    'resize_body' => [
        'path' => '../private/source/pages/layouts/components/html.scripts&endBody/js/resize_body_bootstrap.js',
        'version' => '1.0'
    ],
    'iframe_restrict' => [
        'path' => '../private/source/pages/layouts/components/html.scripts&endBody/js/restriction_against_iframe.js',
        'version' => '1.0'
    ],
    'tooltip' => [
        'path' => '../private/source/pages/layouts/components/html.scripts&endBody/js/tooltip_popover.js',
        'version' => '1.0'
    ]
];

// Scripts externos com integrity
$external_scripts = [
    'bootstrap_js' => [
        'src' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        'integrity' => 'sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL',
        'crossorigin' => 'anonymous'
    ],
    'popper_js' => [
        'src' => 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js',
        'integrity' => 'sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r',
        'crossorigin' => 'anonymous'
    ],
    'fontawesome' => [
        'src' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        'integrity' => 'sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==',
        'crossorigin' => 'anonymous'
    ]
]; 