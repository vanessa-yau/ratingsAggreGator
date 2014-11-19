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
    'as' => 'home'
]);

Route::get('profile', function() {
	return View::make('player-profile');
});

Route::resource('players', 'PlayerController');

Route::resource('ratings', 'RatingController');

Route::get('player/{id}', [
	"as" => "player.profile",
	"uses" => "PlayerController@show"
]);
