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
// to gather data about page views
Route::filter('plusone', function() {
    PageCounter::plusOne();
});

Route::group(['after' => 'plusone'], function() {
    Route::get('/',function() {
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


    Route::get('search/{query?}', [
        'as' => 'players.search',
        'uses' => 'PlayerController@search'
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
    
});

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
    return Player::find(148);
});

Route::get('/averageRatingSummary',[
    'as' => 'players.niceRatingSummary',
    'uses' => 'PlayerController@getNiceRatingSummary'
]);

// Auto generate all CRUD routes to your controllers
Route::resource('attributes', 'AttributeController');

Route::resource('leagues', 'LeagueController');

Route::resource('teams', 'TeamController');

Route::resource('players', 'PlayerController', [
    'except' => ['show']
]);

Route::get('players/{id}/{slug?}', [
    'as' => 'players.show',
    'uses' => 'PlayerController@show'
]);

Route::resource('ratings', 'RatingController');

Route::resource('users', 'UserController');

Route::resource('conversations', 'ConversationsController');

Route::get('/userTimeline', [
    'as' => 'twitter.userTimeline',
    'uses' => 'TwitterController@getUserTimeline'
]); 

Route::get('/homeTimeline', [
    'as' => 'twitter.homeTimeline',
    'uses' => 'TwitterController@getHomeTimeline'
]); 

Route::get('/mentionsTimeline', [
    'as' => 'twitter.mentionsTimeline',
    'uses' => 'TwitterController@getMentionsTimeline'
]);

Route::get('/postTweet', [
    'as' => 'twitter.postTweet',
    'uses' => 'TwitterController@postTweet'
]); 

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

// about the project, *in progress*
Route::get('/about', function()
{
    return 'About RatinGator...';
});


Route::get('/tottPlayers', [
    'as' => 'tottPlayers',
    'uses' => 'PlayerController@getAllPlayersOfTeam'
]);
