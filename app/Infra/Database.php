<?php

namespace App\Infra;

use PDO;
use Exception;

class Database {
  private $host = 'market-db'; // Nome do serviço do MySQL no docker-compose
  private $db = 'my_database'; // Nome do banco de dados
  private $user = 'my_sql_user'; // Usuário do banco de dados
  private $pass = 'my_sql_password'; // Senha do banco de dados
  private $charset = 'utf8mb4';
  private $dsn;
  private $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  public function __construct() {
    $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
  }

  public function getCon() {
    try {
      return new PDO($this->dsn, $this->user, $this->pass, $this->options);
    } catch (PDOException $e) {
      throw new Exception($e->getMessage());
    }
  }
}
