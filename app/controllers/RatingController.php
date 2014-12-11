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

		$validationRulesArray = [];
        $ratingsMappedAgainstSkillName = [];
        $ratingNames = Skill::whereIn('id', array_keys($ratings))->get();

		foreach ($ratings as $ratingId => $rating) {

			// determine the name of the skill
			$skillName = $ratingNames->find($ratingId)->name;

			// create a rule that will ensure that the named skill meets requirements
			$validationRulesArray[$skillName] = 'required|numeric|between:1,5';
        	
        	// map the skill value across to the skill name so that it may be validated
			$ratingsMappedAgainstSkillName[$skillName] = $rating;
		}

		$validator = Validator::make($ratingsMappedAgainstSkillName
			, $validationRulesArray);

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

        	return $player->ratingSummary;
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
