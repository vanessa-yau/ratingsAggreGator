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
    'uses' => 'RatingController@mostPopular'
]);

Route::get('profile', function() {
	return View::make('player-profile');
});

// Auto generate all CRUD routes to your controllers
Route::resource('attributes', 'AttributeController');

Route::resource('players', 'PlayerController');

Route::resource('ratings', 'RatingController');

Route::resource('users', 'UserController');

Route::post('login', [
	'as' => 'users.login',
	'uses' => 'UserController@login'
]);

Route::get('logout', [
	'as' => 'users.logout',
	'uses' => 'UserController@logout'
]);

Route::get(
    'search/{query}',
    array(
        'as' => 'players.search',
        'uses' => 'PlayerController@search'
    )
);

