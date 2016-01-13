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
Route::resource('players', 'PlayersController');

Route::resource('shop', 'ShopsController');
Route::get('shop/payment/accepted', ['uses' => 'ShopsController@accepted']);
Route::get('shop/payment/failed', ['uses' => 'ShopsController@failed']);



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
