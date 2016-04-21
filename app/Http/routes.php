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
Route::get('profil/totp', ['uses' => 'UsersController@totp']);
Route::post('profil/totp', ['uses' => 'UsersController@totp_post']);
Route::get('profil/totp/delete', ['uses' => 'UsersController@totp_delete']);
Route::post('profil', ['uses' => 'UsersController@update']);

Route::get('stream', ['uses' => 'StreamsController@index_home']);
Route::get('stream/{slug}', ['uses' => 'StreamsController@show']);

Route::get('news', ['uses' => 'NewsController@index_home']);
Route::get('news/{slug}', ['uses' => 'NewsController@show']);

Route::get('page/{slug}', ['uses' => 'PagesController@show']);

Route::resource('player', 'PlayersController');
Route::post('player', ['uses' => 'PlayersController@refunds']);
Route::post('player/gang/delete', ['uses' => 'PlayersController@deleteGang', 'as' => 'deleteGang']);
Route::post('player/gang/add', ['uses' => 'PlayersController@addUserGang', 'as' => 'addPlayerGang']);
Route::get('token', ['uses' => 'WelcomeController@token']);

Route::get('remboursement', ['uses' => 'PlayersController@refundsView']);
Route::get('remboursement/{id}', ['uses' => 'PlayersController@show_refunds'])->where('id', '[0-9]+');
Route::post('remboursement/reply/{id}', ['uses' => 'PlayersController@reply_refunds']);

Route::get('shop', ['uses' => 'ShopsController@index_home']);
Route::get('shop/{slug}', ['uses' => 'ShopsController@show']);
Route::get('shop/payment/accepted', ['uses' => 'ShopsController@accepted']);
Route::get('shop/payment/failed', ['uses' => 'ShopsController@failed']);

Route::get('support', ['uses' => 'SupportsController@index']);
Route::get('support/open', ['uses' => 'SupportsController@create']);
Route::post('support/open', ['uses' => 'SupportsController@open']);
Route::get('support/{id}', ['uses' => 'SupportsController@show'])->where('id', '[0-9]+');
Route::post('support/reply/{id}', ['uses' => 'SupportsController@reply']);
Route::get('support/close/{id}', ['uses' => 'SupportsController@close']);

/* Admin Route */
Route::group(['prefix' => 'admin'], function () {
	Route::get('/', ['uses' => 'AdminController@index']);

	Route::post('/licenses', ['uses' => 'AdminController@setLicenses', 'as' => 'setLicenses']);
	Route::get('/paypal', ['uses' => 'AdminController@paypal']);
	Route::get('/search', ['uses' => 'AdminController@search']);

	Route::get('/player', ['uses' => 'AdminController@joueur']);
	Route::get('/player/{id}', ['uses' => 'AdminController@joueurShow', 'as' => 'player'])->where('id', '[0-9]+');
	Route::post('/player/{id}', ['uses' => 'AdminController@updatePlayer']);
	Route::get('/player/connected', ['uses' => 'AdminController@connected']);
	Route::post('/civ_gear/delete', ['uses' => 'AdminController@removePlayer']);

	Route::get('/gang', ['uses' => 'AdminController@gangs']);
	Route::get('/gang/{id}', ['uses' => 'AdminController@gangShow', 'as' => 'gang'])->where('id', '[0-9]+');
	Route::post('/gang/delete', ['uses' => 'AdminController@deleteGang', 'as' => 'deleteGangAdmin']);
	Route::post('/gang/add', ['uses' => 'AdminController@addUserGang', 'as' => 'addPlayerGangAdmin']);

	Route::get('/user', ['uses' => 'AdminController@users']);
	Route::get('/user/{id}', ['uses' => 'AdminController@userShow', 'as' => 'user'])->where('id', '[0-9]+');
	Route::post('/user/{id}', ['uses' => 'AdminController@userUpdate']);

	Route::post('/rcon/say', ['uses' => 'AdminController@rconSay']);

	Route::get('/totp/{id}', ['uses' => 'AdminController@totp']);

	Route::get('/remboursement', ['uses' => 'AdminController@refunds']);
	Route::get('/remboursement/{id}', ['uses' => 'AdminController@refundsShow', 'as' => 'refund'])->where('id', '[0-9]+');
	Route::post('/remboursement/{id}', ['uses' => 'AdminController@refundsUpdate'])->where('id', '[0-9]+');
	Route::post('/remboursement/open/{id}', ['uses' => 'AdminController@refunds_open']);
	Route::get('/remboursement/close/{id}', ['uses' => 'AdminController@refunds_close']);
	Route::get('/remboursement/reopen/{id}', ['uses' => 'AdminController@refunds_reopen']);

	Route::get('/vehicule/{id}', ['uses' => 'AdminController@vehicule']);
	Route::post('/vehicule/{id}', ['uses' => 'AdminController@vehicule_update']);
	Route::post('/vehicule/', ['uses' => 'AdminController@vehicule_delete']);

	Route::get('/house', ['uses' => 'AdminController@house']);

	Route::get('/settings', ['uses' => 'AdminController@settings']);
	Route::post('/settings', ['uses' => 'AdminController@settingsUpdate']);
	Route::post('/settings/parameters', ['uses' => 'AdminController@settingParam']);
	Route::DELETE('/settings/{id}', ['uses' => 'AdminController@settingDestroy']);

	Route::get('/support', ['uses' => 'AdminController@support']);
	Route::get('/support/{id}', ['uses' => 'AdminController@support_show'])->where('id', '[0-9]+');
	Route::get('/support/close/{id}', ['uses' => 'AdminController@close']);
	Route::get('/support/open/{id}', ['uses' => 'AdminController@open']);
	Route::post('/support/reply/{id}', ['uses' => 'AdminController@reply']);

	Route::resource('stream', 'StreamsController');
	Route::resource('news', 'NewsController');
	Route::resource('shop', 'ShopsController');
	Route::resource('page', 'PagesController');
	Route::resource('offense', 'OffensesController');

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('totp', ['uses' => 'Auth\AuthController@totp']);
Route::post('totp', ['uses' => 'Auth\AuthController@totp']);
