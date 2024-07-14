<?php

namespace App\Infra\Http\Controller;

use App\Infra\Http\Config\Request;
use App\Infra\Http\Config\Response;

class HomeController
{
  public function health(Request $request, Response $response)
  {
    $response::json([
      'message' => 'hello world'
    ]);
  }
}