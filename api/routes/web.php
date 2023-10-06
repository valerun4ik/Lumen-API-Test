<?php

/** @var Router $router */

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

use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('register', [
    'uses' => 'Auth\LoginController@register'
]);
$router->post('sign-in', [
    'uses' => 'Auth\LoginController@signIn'
]);
$router->post('user/recover-password-create', [
    'uses' => 'Auth\RecoverPasswordController@createRecoverPassword'
]);
$router->post('user/recover-password-process', [
    'uses' => 'Auth\RecoverPasswordController@processRecoverPassword'
]);

$router->get('user/companies', [
    'middleware' => 'auth',
    'uses' => 'Entities\CompanyController@get'
]);
$router->post('user/companies', [
    'middleware' => 'auth',
    'uses' => 'Entities\CompanyController@store'
]);

