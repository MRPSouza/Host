<?php

  $config = parse_ini_file(__DIR__ . '/../config/credentials.ini', true);
  if (!$config) {
      die('Erro ao carregar o arquivo de configuração.');
  }

  class CREDENTIALS
  {
      private static $config;

      public static function init($config)
      {
          self::$config = $config;
      }

      public static function getCredentials()
      {
          return
          [
              'server'   => self::$config['credentials']['server'],  
              'username' => self::$config['credentials']['username'],
              'password' => self::$config['credentials']['password']  
          ];
      }
  }
  define('DB_HOST', $config['credentials']['server']);
  define('DB_USER', $config['credentials']['username']);
  define('DB_PASSWORD', $config['credentials']['password']);
  CREDENTIALS::init($config);
  
?>