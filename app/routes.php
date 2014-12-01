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

Route::get('/register', [
    'as' => 'users.create',
    'uses' => 'UserController@create'
]);

Route::get('profile', function() {
	return View::make('player-profile');
});

// Auto generate all CRUD routes to your controllers
Route::resource('attributes', 'AttributeController');

Route::resource('players', 'PlayerController');

Route::resource('ratings', 'RatingController');

Route::resource('users', 'UserController');

//Returns a collection of the most recent Tweets posted by the user indicated by the screen_name or user_id parameters.
Route::get('/userTimeLine', function()
{
    return Twitter::getUserTimeline(array('screen_name' => 'screen_name', 'count' => 20, 'format' => 'html'));
});


//Returns a collection of the most recent Tweets and retweets posted by the authenticating user and the users they follow.

Route::get('/homeTimeLine', function()
{
    return Twitter::getHomeTimeline(array('count' => 20, 'format' => 'json'));
});

//Returns the X most recent mentions (tweets containing a users's @screen_name) for the authenticating user.

Route::get('/mentionsTimeLine', function()
{
    return Twitter::getMentionsTimeline(array('count' => 20, 'format' => 'json'));
});

//Updates the authenticating user's current status, also known as tweeting.
Route::get('/postTweet', function()
{
    return Twitter::postTweet(array('status' => 'Laravel is beautiful', 'format' => 'json'));
});


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

Route::get('hello', array(
        'as' => 'hello',
        'uses' => 'PlayerController@getRandomPlayers'
    )
);

Route::get('/countries', function()
{
   print_r( ( json_decode( Countries::getList('en', 'json', 'cldr')) ) );
});

Route::post('register', [
    'as' => 'user.store',
    'uses' => 'UserController@store'
]);

// navbar footer routes
Route::get('/about/meet-the-team', [
    'as' => 'meet-the-team',
    function(){
        return View::make('meet-the-team');
    }
]);

Route::get('/help/contact-us', [
    'as' => 'contact-us',
    function(){
        return View::make('contact-us');
    }
]);