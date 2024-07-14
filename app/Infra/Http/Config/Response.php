<?php

namespace App\Infra\Http\Config;

class Response
{
  public static function json(array $data = [], int $status = 200): void
  {
    http_response_code($status);

    header("Content-Type: application/json");

    echo json_encode($data);
  }
}