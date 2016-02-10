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

Route::get('/', function () {return view('welcome');});

Route::resource('about', 'AboutController',['only' =>['index']]);
Route::resource('store', 'StoreController', ['only' => ['index']]);
Route::get('contact', ['as' => 'contact', 'uses' => 'ContactController@create']);
Route::post('contact', ['as' => 'contact_store', 'uses' => 'ContactController@store']);
Route::get('login', [
  'as' => 'login', 
  'uses' => 'Auth\AuthController@getLogin'
]);

Route::get('logout', [
  'as' => 'logout', 
  'uses' => 'Auth\AuthController@getLogout'
]);

    Route::controllers(['auth' => 'Auth\AuthController','password' => 'Auth\PasswordController']);

});
