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

Route::get('/', function() {
    ( League::count() > 0 ) 
        ? $leagues = League::all() 
        : $leagues = null;

    return View::make('home', [
        'players' => Player::mostPopular(),
        'leagues' => $leagues
    ]);
});

Route::get('/register', [
    'as' => 'users.create',
    'uses' => 'UserController@create'
]);

Route::group(['before' => 'env'], function()
{
    Route::get('/admin/{anomaly}', [
        'as' => 'admin',
        'uses' => 'PlayerController@showAnomalousNames'
    ]);

    Route::get('/admin/{anomaly}/delete', [
        'as' => 'anomalousPlayers.delete',
        'uses' => 'PlayerController@deleteAnomalousNames'
    ]);
});

Route::get('test', function() {
    return View::make('magpie');
});

// Auto generate all CRUD routes to your controllers
Route::resource('attributes', 'AttributeController');

Route::resource('leagues', 'LeagueController');

Route::resource('teams', 'TeamController');

Route::resource('players', 'PlayerController');

Route::resource('ratings', 'RatingController');

Route::resource('users', 'UserController');

//Returns a collection of the most recent Tweets posted by the user indicated by the screen_name or user_id parameters.

Route::get('/userTimeLine', function()
{
    return Twitter::getUserTimeline(['screen_name' => 'iamsamgoml', 'count' => 20, 'format' => 'array']);
});


//Returns a collection of the most recent Tweets and retweets posted by the authenticating user and the users they follow.

Route::get('/homeTimeLine', function()
{
    return Twitter::getHomeTimeline(['count' => 20, 'format' => 'json']);
});

//Returns the X most recent mentions (tweets containing a users's @screen_name) for the authenticating user.

Route::get('/mentionsTimeLine', function()
{
    return Twitter::getMentionsTimeline(['count' => 20, 'format' => 'json']);
});

//Updates the authenticating user's current status, also known as tweeting.
Route::get('/postTweet', function()
{
    return Twitter::postTweet(['status' => 'Test Tweet2', 'format' => 'json']);
});

Route::get('/twitter/login', [
    'as' => 'twitter.login',
    'uses' => 'TwitterController@twitterLogin'
]);  

Route::get('/twitter/callback', [
    'as' => 'twitter.callback',
    'uses' => 'TwitterController@callback'
]); 

Route::get('twitter/error', function(){
    // An error occured
    //TODO: Add some error handling here
});

Route::post('login', [
    'as' => 'users.login',
    'uses' => 'UserController@login'
]);

Route::get('logout', [
    'as' => 'users.logout',
    'uses' => 'UserController@logout'
]);


Route::get('search/{query}', [
    'as' => 'players.search',
    'uses' => 'PlayerController@search'
]);

Route::get('hello', [
    'as' => 'hello',
    'uses' => 'PlayerController@getRandomPlayers'
]);

Route::get('test', [
        'as' => 'test',
        'uses' => 'ScrapeImages2@test'
]);

Route::get('ScrapeImage', 
    ['uses' => 'ScrapeImages2@foo']
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

Route::get('/tottPlayers', [
    'as' => 'tottPlayers',
    'uses' => 'PlayerController@getAllPlayersOfTeam'
]);
