<?php

use App\Infra\Http\Config\Router;

Router::get('/', 'HomeController@health');
Router::post('/product-type', 'ProductTypeController@store');
Router::put('/product-type/{id}', 'ProductTypeController@update');
Router::get('/product-type/{id}', 'ProductTypeController@find');
Router::get('/product-type', 'ProductTypeController@findAll');
Router::delete('/product-type/{id}', 'ProductTypeController@delete');

