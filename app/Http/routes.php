<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

Route::get('/', ['as' => 'contact', 'uses' => 'WelcomeController@create']);

Route::resource('about', 'AboutController',['only' =>['index']]);
Route::get('contact', ['as' => 'contact', 'uses' => 'ContactController@create']);
Route::post('contact', ['as' => 'contact_store', 'uses' => 'ContactController@store']);
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
    
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
    
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
   
Route::resource('products', 'ProductController');
Route::post('cart/store', 'CartController@store');
Route::get('cart', 'CartController@index');
Route::get('cart/remove/{id}', 'CartController@remove');
Route::post('cart/complete', [
 	    'as' => 'cart.complete',
 	    'uses' => 'CartController@complete'
 	]);

Route::controllers(['auth' => 'Auth\AuthController','password' => 'Auth\PasswordController']);

    
Route::group(['prefix' => 'admin', 
              'namespace' => 'Admin',
              'middleware' => 'admin'], function()
 {
    Route::get('/', 'IndexController@index');
    Route::resource('products', 'IndexController');
    Route::resource('orders', 'OrderController');
    Route::resource('products', 'ProductController');
 });

Route::post('checkout', [
    'uses' => 'CheckoutController@index'
]);
Route::get('checkout/thankyou', [
    'as' => 'checkout.thankyou', 'uses' => 'CheckoutController@thankyou'
]);

    
});
