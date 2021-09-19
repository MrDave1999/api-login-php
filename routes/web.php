<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->group(['middleware' => 'auth'], function () use ($router) {

        $router->group(['prefix' => 'user'], function () use ($router) {
            $router->get('/', 'UserController@get');
            $router->put('/', 'UserController@edit');
            $router->delete('/', 'UserController@delete');
        });

    });
    $router->post('login', 'AuthController@login');
    $router->post('users', 'UserController@create');
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->group(['middleware' => ['auth', 'role:admin']], function () use ($router) {

        $router->group(['prefix' => 'users'], function () use ($router) {
            $router->get('/', 'UserController@index');
            $router->get('/{name}', 'UserController@show');
            $router->put('/{name}', 'UserController@update');
            $router->delete('/{name}', 'UserController@destroy');
        });

        
    });
});