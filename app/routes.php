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
    return Twitter::getUserTimeline(array('screen_name' => 'iamsamgoml', 'count' => 20, 'format' => 'array'));
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

Route::get('/twitter/login', function()
{
    // the SIGN IN WITH TWITTER  button should point to this route
    $sign_in_twitter = TRUE;
    $force_login = FALSE;
    $callback_url = 'http://' . $_SERVER['HTTP_HOST'] . '/twitter/callback';
    // Make sure we make this request w/o tokens, overwrite the default values in case of login.
    Twitter::set_new_config(array('token' => '', 'secret' => ''));
    $token = Twitter::getRequestToken($callback_url);
    if( isset( $token['oauth_token_secret'] ) ) {
        $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

        Session::put('oauth_state', 'start');
        Session::put('oauth_request_token', $token['oauth_token']);
        Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

        return Redirect::to($url);
    }
    return Redirect::to('twitter/error');
});

Route::get('/twitter/callback', function() {
    // You should set this route on your Twitter Application settings as the callback
    // https://apps.twitter.com/app/YOUR-APP-ID/settings
    if(Session::has('oauth_request_token')) {
        $request_token = array(
            'token' => Session::get('oauth_request_token'),
            'secret' => Session::get('oauth_request_token_secret'),
        );

        Twitter::set_new_config($request_token);

        $oauth_verifier = FALSE;
        if(Input::has('oauth_verifier')) {
            $oauth_verifier = Input::get('oauth_verifier');
        }

        // getAccessToken() will reset the token for you
        $token = Twitter::getAccessToken( $oauth_verifier );
        if( !isset( $token['oauth_token_secret'] ) ) {
            return Redirect::to('/')->with('flash_error', 'We could not log you in on Twitter.');
        }

        $credentials = Twitter::query('account/verify_credentials');
        if( is_object( $credentials ) && !isset( $credentials->error ) ) {
            // $credentials contains the Twitter user object with all the info about the user.
            // Add here your own user logic, store profiles, create new users on your tables...you name it!
            // Typically you'll want to store at least, user id, name and access tokens
            // if you want to be able to call the API on behalf of your users.

            // This is also the moment to log in your users if you're using Laravel's Auth class
            // Auth::login($user) should do the trick.

            return Redirect::to('/')->with('flash_notice', "Congrats! You've successfully signed in!");
        }
        return Redirect::to('/')->with('flash_error', 'Crab! Something went wrong while signing you up!');
    }
});

Route::get('twitter/error', function(){
    // Something went wrong, add your own error handling here
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

// Route::get('test', array(
//         'as' => 'test',
//         'uses' => 'ImageController@go'
//     )
// );

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
