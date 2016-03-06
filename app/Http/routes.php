<?php

Route::group(['middleware' => ['web']], function () {


Route::get('/', ['as' => 'contact', 'uses' => 'WelcomeController@create']);

Route::resource('about', 'AboutController',['only' =>['index']]);
Route::get('contact', ['as' => 'contact', 'uses' => 'ContactController@create']);
Route::post('contact', ['as' => 'contact_store', 'uses' => 'ContactController@store']);

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
View::composer('inc.nav', 'App\Composers\NavComposer');
Route::post('products/buy',['as'=>'products.buy', 'uses'=> 'ProductController@buy']);
Route::post('products/bid/{id}', ['as' => 'products.bid', 'uses' => 'ProductController@bid']);
 Route::post('products/storeBid', ['as' => 'products.storeBid', 'uses' => 'ProductController@storeBid']);
Route::resource('products', 'ProductController');
Route::post('cart/store', 'CartController@store');
Route::get('cart', 'CartController@index');
Route::get('cart/remove/{id}', 'CartController@remove');
Route::post('cart/complete', ['as' => 'cart.complete','uses' => 'CartController@complete']);

Route::controllers(['auth' => 'Auth\AuthController','password' => 'Auth\PasswordController']);


Route::group(['prefix' => 'admin',
              'namespace' => 'Admin',
              'middleware' => 'admin'], function()
 {
    Route::get('/', 'IndexController@index');
     Route::get('products/createBid/{id}', ['as' => 'admin.products.createBid', 'uses' => 'ProductController@createBid']);
     Route::post('products/storeBid', ['as' => 'admin.products.storeBid', 'uses' => 'ProductController@storeBid']);
     Route::get('products/deleteBid/{id}', ['as' => 'admin.products.deleteBid', 'uses' => 'ProductController@deleteBid']);
    Route::resource('products', 'IndexController');
    Route::resource('orders', 'OrderController');
    Route::resource('products', 'ProductController');

 });

Route::post('checkout', ['uses' => 'CheckoutController@index']);
Route::get('checkout/thankyou', ['as' => 'checkout.thankyou', 'uses' =>'CheckoutController@thankyou']);


});
