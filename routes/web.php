<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('register', [
    'as' => 'register',
    'uses' => 'AuthController@register'
]);

$router->post('login', [
    'as' => 'login',
    'uses' => 'AuthController@login'
]);

$router->post('refresh', [
    'as' => 'refresh',
    'uses' => 'AuthController@refresh'
]);

$router->get('cars', [
    'as' => 'index',
    'uses' => 'Api\v1\CarController@index'
]);
