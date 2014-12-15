<?php

class ConversationsController extends \BaseController {

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
		// create a new conversation associated with the current user and their intended recipient
		//$convArray = Auth::user()->conversations()->get()->toArray();
		//var_dump($convArray);

		$username = Input::get('username');
		$user = User::whereUsername($username)->first();
		if($user) {
			$conversation = Conversation::create([ 'name' => (Auth::user()->username."/".$username) ]);
			$conversation->users()->attach(Auth::user()->id);
			$conversation->addUser([$user->email]);

			return Response::json(["Conversation with ".$username." started!"], 200);
		} else {
			return Response::json(["The user you have specifed does not exist.  Sorry about that."], 400);
		}
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


}
