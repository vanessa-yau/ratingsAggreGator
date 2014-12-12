<?php
use Carbon\Carbon;

class GameController extends \BaseController {

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

	public function prepareGraph($values = []) {
		if (!$values)
			Input::all();
		
		$values = array_only($values, [
			'team1_id',
			'team2_id',
			'date'
		]);


		Clockwork::info($values);

		$validator = $this->buildValidator($values);
		$models = [];
		$player = Player::find( Input::get('player_id') );
		$game = null;
		if ($validator->passes()) {
			$game = Game::whereDate($values['date'])
	    		->whereTeam1Id($values['team1_id'])
	    		->whereTeam2Id($values['team2_id'])
	    		->orWhere(function ($query) use ($values) {
	    			$query->whereTeam1Id($values['team2_id'])
	    				  ->orWhere('team2_id', $values['team1_id']);
	    		})
	    		->first();

	    	if (!$game) {
	    		$game = new Game;
	    		$values['sport_id'] = $player->sport->id;
	    		$game->fill($values);
	    	}
		}

		return [
			'ok' => $validator->passes(),
			'messages' => $validator->messages(),
			'game' => $game,
			'player' => $player,
			'saver' => function () use ($models, $player) {
				$team = $player->lastKnownTeam;
				foreach($models as $game) {
					$game->save();

					// associate the player in this game
					// only if the 
					$needsAttaching = Game_Player::whereGameId($game->id)
						->wherePlayerId($player->id)
						->count() == 0;

					if ($needsAttaching)
						$player->games()->attach($game->id, [
							'team_id' => $team->id,
							'league_id' => $team->last_known_league_id
						]);
				}
			}
		];
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$graph = $this->prepareGraph();
		return $graph['ok']
			? $graph['game']
			: Response::json($graph['messages'], 400);
	}

	public function buildValidator($gameInfo) {
		// convert the carbon date format into a format that works with the datepicker on the form.
		// see http://www.tisuchi.com/php-date-time-customization-carbon/ for how to retrieve dd.mm.yyyy
		// see http://php.net/manual/en/function.date-parse-from-format.php
		$validator = Validator::make($gameInfo, [
			'team1_id' => 'required|integer|exists:teams,id',
			'team2_id' => 'required|integer|exists:teams,id',
			'date' => 'required|date|before:'. Carbon::now()->addDay() . '|after:'. Carbon::now()->subDays(30)
		]);

		return $validator;
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
