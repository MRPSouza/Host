<?php
$EXTERNAL_SCRIPT_HASHES = [];

$external_scripts = [
    'jquery' => [
        'url' => 'https://code.jquery.com/jquery-3.6.0.min.js',
        'integrity' => 'sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK',
        'hash' => null
    ]
    // Adicione mais scripts externos aqui
];

// Gerar hash para cada script externo
foreach ($external_scripts as $key => &$script) {
    $EXTERNAL_SCRIPT_HASHES[$key] = $script['integrity'];
}
?>