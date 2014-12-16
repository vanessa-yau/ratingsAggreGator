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
		// var_dump($ratingGraph['ratingsBranch']['ratings']);
		// var_dump($ratingGraph['gameBranch']['models']);
		// die();

		return $ratingGraph['ok']
			? $this->saveGraph($ratingGraph)
			: Response::make($ratingGraph['messages'], 400);

	}

	// walks across our object graph and saves every branch
	public function saveGraph($graph) {
		$graph['saver']();
		
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
			'messages' => $ratingsBranch['messages']->merge($gameBranch['messages']),
			'saver' => function() use ($ratingsBranch, $gameBranch) {
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
			'saver' => function () use ($models) {
				foreach($models as $model) {
					$model->save();
				}
			}
		];
	}

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
