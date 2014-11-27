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
		return ( Auth::check() ? View::make('player-profile') : View::make('hello'));
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
