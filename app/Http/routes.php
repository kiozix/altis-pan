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
Route::post('player', ['uses' => 'PlayersController@refunds']);
Route::get('remboursement', ['uses' => 'PlayersController@refundsView']);
Route::post('player/gang/delete', ['uses' => 'PlayersController@deleteGang', 'as' => 'deleteGang']);
Route::post('player/gang/add', ['uses' => 'PlayersController@addUserGang', 'as' => 'addPlayerGang']);

Route::resource('shop', 'ShopsController');
Route::get('shop/payment/accepted', ['uses' => 'ShopsController@accepted']);
Route::get('shop/payment/failed', ['uses' => 'ShopsController@failed']);

Route::get('admin', ['uses' => 'AdminController@index']);
Route::get('admin/players', ['uses' => 'AdminController@joueur']);
Route::get('admin/player/{id}', ['uses' => 'AdminController@joueurShow', 'as' => 'player']);
Route::post('admin/player/{id}', ['uses' => 'AdminController@updatePlayer']);
Route::post('admin/licenses', ['uses' => 'AdminController@setLicenses', 'as' => 'setLicenses']);
Route::get('admin/paypal', ['uses' => 'AdminController@paypal']);
Route::get('admin/search', ['uses' => 'AdminController@search']);
Route::post('admin/user/update/{id}', ['uses' => 'AdminController@updateUser']);
Route::get('admin/gangs', ['uses' => 'AdminController@gangs']);
Route::get('admin/gang/{id}', ['uses' => 'AdminController@gangShow', 'as' => 'gang']);
Route::post('admin/gang/delete', ['uses' => 'AdminController@deleteGang', 'as' => 'deleteGangAdmin']);
Route::post('admin/gang/add', ['uses' => 'AdminController@addUserGang', 'as' => 'addPlayerGangAdmin']);
Route::get('admin/users', ['uses' => 'AdminController@users']);
Route::get('admin/user/{id}', ['uses' => 'AdminController@userShow', 'as' => 'user']);
Route::post('admin/user/{id}', ['uses' => 'AdminController@userUpdate']);
Route::get('admin/remboursements', ['uses' => 'AdminController@refunds']);
Route::get('admin/remboursement/{id}', ['uses' => 'AdminController@refundsShow', 'as' => 'refund']);
Route::post('admin/remboursement/{id}', ['uses' => 'AdminController@refundsUpdate']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
