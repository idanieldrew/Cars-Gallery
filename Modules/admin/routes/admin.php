<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/','AdminController@index');

// store car
$router->post('{category}/car', [
    'as' => 'store-car',
    'uses' => 'CarController@store'
]);