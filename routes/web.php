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



// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('addService', 'ServiceController@addService');
    $router->get('getAllServices', 'ServiceController@getAllServices');
    $router->get('getServiceById/{id}', 'ServiceController@getServiceById');
    $router->post('updateService', 'ServiceController@updateService'); 
    $router->get('deleteServiceById/{id}', 'ServiceController@deleteServiceById');
    $router->post('getServicesWithFilter', 'ServiceController@getServicesWithFilter');

});