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

    $router->group(['middleware' => 'auth'], function () use ($router) {

        $router->get('verify/{id}/{hash}', [
            'middleware' => ['signed', 'throttle:6,1'],
            'as' => 'verify',
            'uses' => 'EmailVerificationController@invoke'
        ]);
        $router->post('verify/resend', [
            'middleware' => ['signed', 'throttle:6,1'],
            'as' => 'verify',
        ], function () {
            return 'success';
        });
    });
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

    $router->get('allc', [
        'uses' => 'CommentController@index'
    ]);
});
