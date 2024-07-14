<?php

use App\Infra\Http\Config\Router;

Router::get('/', 'HomeController@health');
Router::post('/product-type', 'ProductTypeController@store');
Router::put('/product-type/{id}', 'ProductTypeController@update');
Router::get('/product-type/{id}', 'ProductTypeController@find');
Router::get('/product-type', 'ProductTypeController@findAll');
Router::delete('/product-type/{id}', 'ProductTypeController@delete');


Router::post('/product', 'ProductController@store');
Router::put('/product/{id}', 'ProductController@update');
Router::get('/product/{id}', 'ProductController@find');
Router::get('/product', 'ProductController@findAll');
Router::delete('/product/{id}', 'ProductController@delete');
