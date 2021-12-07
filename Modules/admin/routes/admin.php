<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/','AdminController@index');

// store car
$router->post('{category}/store/car', [
    'as' => 'store-car',
    'uses' => 'CarController@store'
]);

// store category
$router->post('store/category', [
    'as' => 'store-category',
    'uses' => 'ManageCategoryController@store'
]);

