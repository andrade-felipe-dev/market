<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Infra/Http/route.php';
require_once __DIR__ . '/app/Infra/Http/cors.php';

use App\Infra\Http\Config\Dispatcher;
use App\Infra\Http\Config\Router;


Dispatcher::execute(Router::routes());