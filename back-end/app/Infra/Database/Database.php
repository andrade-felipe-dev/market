<?php

namespace App\Infra\Database;

use App\Infra\PDOException;
use Exception;
use PDO;

class Database {
  private $host = 'db';
  private $db = 'market_db';
  private $user = 'my_user';
  private $pass = 'my_password';

  private $port = 5432;
  private $dsn;

  public function __construct()
  {

  }

  public static function getCon()
  {
    $pdo = new PDO("pgsql:host=db;port=5432;dbname=market_db", "my_user", "my_password");

    return $pdo;
  }
}
