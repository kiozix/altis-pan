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

Route::get('stream', ['uses' => 'StreamsController@index_home']);
Route::get('stream/{slug}', ['uses' => 'StreamsController@show']);

Route::get('news', ['uses' => 'NewsController@index_home']);
Route::get('news/{slug}', ['uses' => 'NewsController@show']);

Route::resource('player', 'PlayersController');
Route::post('player', ['uses' => 'PlayersController@refunds']);
Route::get('remboursement', ['uses' => 'PlayersController@refundsView']);
Route::post('player/gang/delete', ['uses' => 'PlayersController@deleteGang', 'as' => 'deleteGang']);
Route::post('player/gang/add', ['uses' => 'PlayersController@addUserGang', 'as' => 'addPlayerGang']);

Route::resource('shop', 'ShopsController');
Route::get('shop/payment/accepted', ['uses' => 'ShopsController@accepted']);
Route::get('shop/payment/failed', ['uses' => 'ShopsController@failed']);

/* Admin Route */
Route::group(['prefix' => 'admin'], function () {
	Route::get('/', ['uses' => 'AdminController@index']);

	Route::post('/licenses', ['uses' => 'AdminController@setLicenses', 'as' => 'setLicenses']);
	Route::get('/paypal', ['uses' => 'AdminController@paypal']);
	Route::get('/search', ['uses' => 'AdminController@search']);

	Route::get('/player', ['uses' => 'AdminController@joueur']);
	Route::get('/player/{id}', ['uses' => 'AdminController@joueurShow', 'as' => 'player']);
	Route::post('/player/{id}', ['uses' => 'AdminController@updatePlayer']);

	Route::get('/gang', ['uses' => 'AdminController@gangs']);
	Route::get('/gang/{id}', ['uses' => 'AdminController@gangShow', 'as' => 'gang']);
	Route::post('/gang/delete', ['uses' => 'AdminController@deleteGang', 'as' => 'deleteGangAdmin']);
	Route::post('/gang/add', ['uses' => 'AdminController@addUserGang', 'as' => 'addPlayerGangAdmin']);

	Route::post('/user/update/{id}', ['uses' => 'AdminController@updateUser']);
	Route::get('/user', ['uses' => 'AdminController@users']);
	Route::get('/user/{id}', ['uses' => 'AdminController@userShow', 'as' => 'user']);
	Route::post('/user/{id}', ['uses' => 'AdminController@userUpdate']);

	Route::get('/remboursement', ['uses' => 'AdminController@refunds']);
	Route::get('/remboursement/{id}', ['uses' => 'AdminController@refundsShow', 'as' => 'refund']);
	Route::post('/remboursement/{id}', ['uses' => 'AdminController@refundsUpdate']);

	Route::resource('stream', 'StreamsController');
	Route::resource('news', 'NewsController');

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
