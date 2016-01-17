<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('profil', ['uses' => 'UsersController@edit', 'as' => 'profil']);
Route::post('profil', ['uses' => 'UsersController@update']);

Route::resource('stream', 'StreamsController');
Route::resource('news', 'NewsController');
Route::resource('player', 'PlayersController');

Route::resource('shop', 'ShopsController');
Route::get('shop/payment/accepted', ['uses' => 'ShopsController@accepted']);
Route::get('shop/payment/failed', ['uses' => 'ShopsController@failed']);

Route::get('admin', ['uses' => 'AdminController@index']);
Route::get('admin/players', ['uses' => 'AdminController@joueur']);
Route::get('admin/player/{id}', ['uses' => 'AdminController@joueur_show', 'as' => 'player']);
Route::post('admin/player/{id}', ['uses' => 'AdminController@updatePlayer']);
Route::get('admin/paypal', ['uses' => 'AdminController@paypal']);
Route::get('admin/search', ['uses' => 'AdminController@search']);
Route::post('admin/user/update/{id}', ['uses' => 'AdminController@updateUser']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
