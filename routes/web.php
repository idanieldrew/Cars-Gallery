<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Auth routes
$router->group(['namespace' => 'Auth'], function () use ($router) {

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
});

// other api
$router->group(['middleware' => 'auth:api', 'namespace' => 'Api\v1'], function () use ($router) {

    // car
    $router->get('cars', [
        'as' => 'index',
        'uses' => 'CarController@index'
    ]);

    // single car
    $router->get('cars/{car}', [
        'as' => 'show',
        'uses' => 'CarController@show'
    ]);

    // remove car
    $router->delete('cars/{car}', [
        'as' => 'delete',
        'uses' => 'CarController@delete'
    ]);

    // filter car with category
    $router->get('cars', [
        'as' => 'filter',
        'uses' => 'CarController@filter'
    ]);

    $router->get('category', [
        'as' => 'index',
        'uses' => 'CategoryController@index'
    ]);
});
