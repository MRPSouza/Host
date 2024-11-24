<?php

  require_once __DIR__ . '/../lib/db_credential.php';

  $credentials = CREDENTIALS::getCredentials();
  CREDENTIALS::init($credentials);

  class CONNECT_DATABASE
  {
    private $host;
    private $user;
    private $password;
    private $database;
    private $conn;

    public function __construct($database = null)
    {
      $this->host = DB_HOST;
      $this->user = DB_USER;
      $this->password = DB_PASSWORD;
      $this->database = $database;
      
      $this->connect();
    }

    private function connect()
    {
      $this->conn = new mysqli(
        $this->host,
        $this->user,
        $this->password,
        $this->database
      );

      if ($this->conn->connect_error) {
        die("Conexão falhou: " . $this->conn->connect_error);
      }

      $this->conn->set_charset("utf8mb4");
    }

    public function prepare($sql)
    {
      return $this->conn->prepare($sql);
    }

    public function begin_transaction()
    {
      return $this->conn->begin_transaction();
    }

    public function commit()
    {
      return $this->conn->commit();
    }

    public function rollback()
    {
      return $this->conn->rollback();
    }

    public function get_insert_id()
    {
      return $this->conn->insert_id;
    }

    public function close()
    {
      if ($this->conn) {
        $this->conn->close();
      }
    }
  }

?>