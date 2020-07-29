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
Route::redirect('/', '/products')->name('root');
Auth::routes(['verify' => true]);

// 商品列表
Route::get('products', 'ProductsController@index')->name('products.index');

// 商品收藏
Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');

Route::group(['middleware' => ['auth', 'verified']], function () {
    // 收货地址
    Route::resource('user_addresses', 'UserAddressesController');

    // 商品收藏
    Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');

    // 购物车
    Route::post('cart', 'CartController@add')->name('cart.add');
    Route::get('cart', 'CartController@index')->name('cart.index');
    Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');

    // 订单
    Route::post('orders', 'OrdersController@store')->name('orders.store');
    Route::get('orders', 'OrdersController@index')->name('orders.index');
    Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');
});

// 支付宝
Route::get('alipay', function () {
    $alipay = app('alipay')->web([
        'out_trade_no' => time(),
        'total_amount' => '1',
        'subject' => 'test subject - 测试',
    ]);

    return $alipay;
});

// 商品详细
Route::get('products/{product}', 'ProductsController@show')->name('products.show');
