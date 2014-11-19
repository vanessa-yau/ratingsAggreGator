<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',  [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('profile', function() {
	return View::make('player-profile');
});

// Auto generate all CRUD routes to your controllers
Route::resource('player', 'PlayerController');

Route::resource('rating', 'RatingController');

Route::resource('user', 'UserController');

Route::post('login', [
	'as' => 'user.login',
	'uses' => 'UserController@login'
]);

Route::post('logout', [
	'as' => 'user.logout',
	'uses' => 'UserController@logout'
]);

