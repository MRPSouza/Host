<?php
// class Language {
//     private static $lang = 'pt_BR';
//     private static $translations = [
//         'pt_BR' => [
//             'whats_your_name' => 'Qual é seu nome?'
//         ],
//         'en_US' => [
//             'whats_your_name' => 'What\'s your name?'
//         ]
//     ];
    
//     public static function set($lang) {
//         self::$lang = $lang;
//     }
    
//     public static function get($key) {
//         // Retorna tradução baseada na chave
//         return self::$translations[self::$lang][$key] ?? $key;
//     }
// } 

// // Exemplo de uso
//     // require_once 'Host/backstage/lib/Language.php';

//     // Primeiro mostra em português
//     Language::set('pt_BR');
//     echo "<h1>" . Language::get('whats_your_name') . "</h1>";

//     // Depois mostra em inglês
//     Language::set('en_US');
//     echo "<h1>" . Language::get('whats_your_name') . "</h1>";
// ?>

