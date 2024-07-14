<?php

namespace App\Infra\Http\Config;

class Request
{
  public static function method(): string
  {
    return $_SERVER['REQUEST_METHOD'];
  }
  public static function body(): mixed
  {
    $json = json_decode(file_get_contents('php://input'), true) ?? [];

    return match(self::method()) {
      'GET' => $_GET,
      'POST', 'PUT', 'DELETE' => $json,
    };
  }
}