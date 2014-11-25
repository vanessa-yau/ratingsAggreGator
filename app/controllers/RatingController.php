<?php

class RatingController extends \BaseController {

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
		// get player info inputs from form
		$player = Player::find( Input::get('player_id') );
		$ratings = Input::get('ratings');
		$ratingIds = array_keys($ratings);

		$validationRulesArray = [];
		foreach ($ratingIds as $ratingId) {
			$validationRulesArray[$ratingId] = 'required|numeric|digits_between:1,5';
		}

		$validator = Validator::make($ratings, $validationRulesArray);

        // if validation passes, run query to insert and return newly created rating.
        if ($validator->fails()) {
            return Response::json( $validator->messages(), 400);
        } else {
        	foreach ($ratings as $skill_id => $value) {
        		//if (!Session::has('rated' . $player->id))
	        		$player->ratings()->create([
			            'originating_ip'    => $_SERVER['REMOTE_ADDR'],
			            'skill_id'	 		=> $skill_id,
			            'value' 			=> $value,
			            'game_id' 			=> 1,
			            'user_id'			=> Auth::check()
			            							? Auth::id()
			            							: -1
			        ]);
        	}

        	// remember that this session has already had a rating
        	// Session::put('rated' . $player->id, true);

        	return $player->getRatingSummary();
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

	/**
	 * Returns the 10 most popularly voted players on the current date
	 *
	 * @return Response
	 */
	public function mostPopular()
	{	
		// retrieve all players and sort by the number of ratings
		$players = Player::byPopularity();

		// restrict the list to the top 10
		$players = $players->slice(0,10);
 		//return $players->count();
		return View::make('home', compact('players'));
	}
}
