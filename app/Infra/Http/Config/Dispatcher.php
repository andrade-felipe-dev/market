<?php

namespace App\Infra\Http\Config;

use App\Infra\Http\Config\Response;

class Dispatcher
{
  public static function execute(array $routes): void
  {
    $initUrl = '';
    $prefixController = 'App\\Infra\\Http\\Controller\\';
    $routeFound = false;

    isset($_SERVER['REQUEST_URI']) && $initUrl .= $_SERVER['REQUEST_URI'];

    foreach ($routes as $route) {
      $pattern = '#^'. preg_replace('/{id}/', '([\w-]+)', $route['uri']) .'$#';

      if (preg_match($pattern, $initUrl, $matches)) {
        array_shift($matches);
        $routeFound = true;

        if ($route['method'] !== Request::method()) {
          continue;
        }

        [$controller, $action] = explode('@', $route['action']);
        $controller = $prefixController . $controller;
        $extendController = new $controller;
        $extendController->$action(new Request, new Response, $matches);
        return;
      }
    }

    if (!$routeFound) {
      Response::json([
        'error' => true,
        'success' => false,
        'message' => 'sorry, route not found'
      ], 404);
    }

    Response::json([
      'error' => true,
      'success' => false,
      'message' => 'sorry, method not allowed'
    ], 405);
  }
}