<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

      // oauth2
      $router->post('login-google', [
            'as' => 'login-google',
            'uses' => 'SocialiteController@login'
      ]);
});
