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

		$ratingGraph = $this->prepareGraph();

		return $ratingGraph['ok']
			? $this->saveGraph($ratingGraph)
			: Response::make($ratingGraph['messages'], 400);

	}

	// walks across our object graph and saves every branch
	public function saveGraph($graph) {
		//creates (if necessary) the ratings and game objects
		$graph['saver']();
		// returns the player object with the rating summary, and associated stats
		return $graph['gameBranch']['player'];
	}

	// prepares all of the object graph (ratings / game?) but
	// does not write to the DB!
	public function prepareGraph($values = null) {
		if (!$values)
			$values = Input::all();

		$ratingsBranch = $this->prepareRatingsBranch($values);
		$gameBranch = $this->prepareGameBranch($values);

		return [
			'ok' => $ratingsBranch['ok'] && $gameBranch['ok'],
			// merges the validation messages into one message bag
			'messages' => $ratingsBranch['messages']->merge($gameBranch['messages']),
			'saver' => function() use ($ratingsBranch, $gameBranch) {
				// creates the ratings and games respectively
				$ratingsBranch['saver']();
				$gameBranch['saver']();
			},
			'ratingsBranch' => $ratingsBranch,
			'gameBranch' => $gameBranch
		];
	}

	public function prepareRatingsBranch($values = null) {
		if (!$values)
			Input::all();

		$values = array_only($values, ['ratings', 'player_id']);
		
		// build the validator
		$validationRulesArray = [];
        $ratingsMappedAgainstSkillName = [];
        $ratingNames = Skill::whereIn('id', array_keys($values['ratings']))->get();

		foreach ($values['ratings'] as $ratingId => $rating) {
			// determine the name of the skill
			$skillName = $ratingNames->find($ratingId)->name;

			// create a rule that will ensure that the named skill meets requirements
			$validationRulesArray[$skillName] = 'required|numeric|between:1,5';
        	
        	// map the skill value across to the skill name so that it may be validated
			$ratingsMappedAgainstSkillName[$skillName] = $rating;
		}

		// run validators.
		$validator = Validator::make($ratingsMappedAgainstSkillName, $validationRulesArray);
		$models = [];
		if ($validator->passes()) {
			foreach ($values['ratings'] as $skill_id => $value) {
        		
        		$model = new Rating;
        		// fill creates the rating instance but does not save it. 
        		// and $_SERVER['REMOTE_ADDR'] stores the IP address of the user for our use.
        		$model->fill([
        			'player_id'			=> $values['player_id'],
		            'originating_ip'    => $_SERVER['REMOTE_ADDR'],
		            'skill_id'	 		=> $skill_id,
		            'value' 			=> $value,
		            'game_id' 			=> 1,
		            'user_id'			=> Auth::check()
		            							? Auth::id()
		            							: -1
		        ]);

        		$models[] = $model;
        	}
		}

		return [
			'ok' => $validator->passes(),
			'messages' => $validator->messages(),
			'ratings' => $models,
			// "use" gives variables which don't have scope scope.
			// about anonymous function and use
			// see http://php.net/manual/en/language.namespaces.php
			'saver' => function () use ($models) {
				foreach($models as $model) {
					$model->save();
				}
			}
		];
	}

	// pass the storing of the game and game_player records to the game controller
	public function prepareGameBranch($values = null) {
		$gameController = new GameController;
		return $gameController->prepareGraph($values);
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
