<?php
use App\Http\Controllers\ProductController;
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

// API ENDPOINT

$router->group(['prefix' => 'api/v1/',],  function()use ($router){

        $router->group(['prefix' => 'auth'], function() use ($router){
            $router->post('/register', 'AuthController@register');
            $router->post('/login', 'AuthController@login');
        });

        $router->group(['prefix' => 'user'], function() use ($router){
            $router->get('/profile', 'UserController@profile');

            $router->group(['prefix' => 'products'], function() use ($router){
                $router->get('/', 'ProductController@index');
                $router->get('/{id}', 'ProductController@show');
                $router->post('/', 'ProductController@store');
                $router->put('/{id}', 'ProductController@update');
                $router->delete('/{id}', 'ProductController@destroy');
            });
        });

    });
