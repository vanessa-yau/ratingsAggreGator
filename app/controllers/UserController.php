<?php

class UserController extends \BaseController {

	public function __construct() {
		$this->beforeFilter('auth', [
			'except' => [
				'store',
				'show',
				'create',
				'login'
			]
		]);
	}

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
		// $countries = User::getCountryList();
		return View::make('register',compact('countries'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = User::create(array(
			'first_name' 		=> Input::get('first_name'),
			'surname' 			=> Input::get('surname'),
			'username' 			=> Input::get('username'),
			'password' 			=> Input::get('password'),
			'dob' 				=> Input::get('dob'),
			'email_address' 	=> Input::get('email_address'),
			'country_code' 		=> Input::get('country'),
			'town/city' 		=> Input::get('town-city'),
		));
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
		$user = User::find($id);

		$userData = [
		    'id' => $user->id,
		    'username' => $user->username,
		    'name' => $user->first_name,
		    'surname' => $user->surname,
		    'email' => $user->email_address,
		    'country' => $user->country_code
		];

		$ratings = Rating::where('user_id', '=', $id)
		                ->orderBy('updated_at', 'DESC')
		                ->get();

		return View::make('user-profile', compact('userData', 'ratings'));
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

	public function login()
	{
		$values = Input::only('username','password');
		
		return( Auth::attempt([
			'username'=>$values['username'],
			'password'=>$values['password']
		]) 
			? Redirect::back()
			: Redirect::back()->with('message', 'Authentication failed, bad username or password.')
		);
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::back();
	}
		
}
