<?php

class TwitterController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * //Returns a collection of the 20 most recent Tweets posted by the 
	 * user indicated by the screen_name or user_id parameters.
	 *
	 * @return Response
	 */
	public function getUserTimeline()
	{
		return Twitter::getUserTimeline(['screen_name' => 'iamsamgoml', 'count' => 20, 'format' => 'array']);
	}

	/**
	 * //Returns a collection of the 20 most recent Tweets and retweets posted by the 
	 * authenticating user and the users they follow. 
	 *
	 * @return Response
	 */
	public function getHomeTimeline()
	{
    	return Twitter::getHomeTimeline(['count' => 20, 'format' => 'json']);
	}

	/**
	 * //Returns the 20 most recent mentions (tweets containing a users's @screen_name) for the authenticating user.
	 *
	 * @return Response
	 */
	public function getMentionsTimeline()
	{
    	return Twitter::getMentionsTimeline(['count' => 20, 'format' => 'json']);
	}

	/**
	 * //Updates the authenticating user's current status, also known as tweeting.
	 *
	 * @return Response
	 */
	public function postTweet()
	{
    	return Twitter::postTweet(['status' => 'Test Tweet2', 'format' => 'json']);
	}

	/**
	 * //Enables user to login via twitterget
	 *
	 * @return Response
	 */
	public function twitterLogin()
	{
		// the SIGN IN WITH TWITTER  button should point to this route

    	//Clear any data from the session
	    Session::clear();
	    $sign_in_twitter = TRUE;
	    $force_login = FALSE;

	    //Define the callback url
	    $callback_url = 'http://' . $_SERVER['HTTP_HOST'] . '/twitter/callback';

	    // Make sure we make this request w/o tokens, overwrite the default values in case of login.
	    Twitter::set_new_config(['token' => '', 'secret' => '']);
	    $token = Twitter::getRequestToken($callback_url);
	    if( isset( $token['oauth_token_secret'] ) ) {
	        $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

	        //Add oauth state and oauth tokens into the session data
	        Session::put('oauth_state', 'start');
	        Session::put('oauth_request_token', $token['oauth_token']);
	        Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

	        return Redirect::to($url);
	    }
	    return Redirect::to('twitter/error');
	}

}
