<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('users', 'UsersController@index');
    $router->resource('products', 'ProductsController');
//    $router->get('products', 'ProductsController@index');
//    $router->get('products/create', 'ProductsController@create');
//    $router->post('products', 'ProductsController@store');

});
