<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});



// other api
$router->group(['namespace' => 'Api\v1'], function () use ($router) {

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
    $router->get('cars-filter', [
        'as' => 'filter',
        'uses' => 'CarController@filter'
    ]);

    // all categories
    $router->get('category', [
        'as' => 'index',
        'uses' => 'CategoryController@index'
    ]);

    // add like or dislike
    $router->post('cars/{car}/like', [
        'as' => 'like',
        'uses' => 'LikeController@like'
    ]);

    // create comment
    $router->post('cars/{car}/comment', [
        'as' => 'create-comment',
        'uses' => 'CommentController@comment'
    ]);

    // create reply for comment
    $router->post('cars/{car}/reply', [
        'as' => 'create-comment',
        'uses' => 'CommentController@replyStore'
    ]);

    // api weblog
    $router->get('weblog', [
        'as' => 'weblog',
        'uses' => 'WeblogController@weblog'
    ]);
});

require __DIR__ . '/auth.php';