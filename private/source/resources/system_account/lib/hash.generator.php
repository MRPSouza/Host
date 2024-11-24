<?php
$config = parse_ini_file(__DIR__ . '/../config/hash.ini', true);
if (!$config) {
    die('Erro ao carregar o arquivo de configuração do hash.');
}

class HASH_GENERATOR
{
    private static $config;

    public static function init($config)
    {
        self::$config = $config;
    }

    public static function getHashSalts()
    {
        return [
            'prefix' => self::$config['hash']['prefix'],
            'suffix' => self::$config['hash']['suffix']
        ];
    }
}

// Define as constantes
define('HASH_SALT_PREFIX', $config['hash']['prefix']);
define('HASH_SALT_SUFFIX', $config['hash']['suffix']);
HASH_GENERATOR::init($config);
?> 