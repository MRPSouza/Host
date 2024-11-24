<?php
$external_scripts = [
    'jquery' => [
        'url' => 'https://code.jquery.com/jquery-3.6.0.min.js',
        'integrity' => 'sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK'
    ]
];

// Renderizar scripts com SRI (Subresource Integrity)
foreach ($external_scripts as $script) {
    echo '<script src="' . $script['url'] . '" 
        integrity="' . $script['integrity'] . '" 
        crossorigin="anonymous"></script>';
}
?>