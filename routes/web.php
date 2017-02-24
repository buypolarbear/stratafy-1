<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'OwnerController@resolutions');

Route::group(['prefix' => 'owners'], function(\Illuminate\Routing\Router $router) {
    $router->get('', 'OwnerController@index');
    $router->get('create', 'OwnerController@create');
    $router->post('', 'OwnerController@store');
    $router->get('{owner}/edit', 'OwnerController@edit');
    $router->post('{owner}', 'OwnerController@update');
});

Route::group(['prefix' => 'resolutions'], function(\Illuminate\Routing\Router $router) {
    $router->get('', 'ResolutionController@index');
    $router->get('create', 'ResolutionController@create');
    $router->post('', 'ResolutionController@store');
    $router->get('{resolution}/edit', 'ResolutionController@edit');
    $router->post('{resolution}', 'ResolutionController@update');
    $router->get('{resolution}', 'ResolutionController@show');
    $router->get('{resolution}/vote/{owner}', 'ResolutionController@show');
    $router->post('{resolution}/vote/{owner}', 'ResolutionController@vote');
});
