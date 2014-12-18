<?php

class PlayerController extends \BaseController {

	public function __construct() {
		// page views counter filter
		$this->afterFilter('plusone', [
			'only' => [
				'index',
				'show'
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
		$player = Player::with('lastKnownTeam.lastKnownPlayers.lastKnownTeam')->find($id);
		
		if( !$player ){
			return View::make('search-results', [
				'results' => null
			]);
		}

		$ratingProfile = RatingProfile::whereSportId($player->sport_id)
							->get()
							->first();

		$skills = $ratingProfile
							->skills()
							->get();

		// if the player belongs to a team get the team
		if ( $player->last_known_team ) {
			$team = Team::find( $player->last_known_team );

			// if the team belongs to a league then find the information about the league
			if( $team->last_known_league_id ){
				// since leagues are unique assume we can get the first league
				$league = League::find($team->last_known_league_id)->first();
			}
		}
		else {
			$team = null;
			$lastKnownPlayers = null;
			$league = null;
		}
		$ratingSummary = $player->ratingSummary;

		// change back to player-profile
		return View::make('player-profile', compact('player', 'skills', 'ratingSummary' ,'team', 'league'));
	}

	public function showAnomalousNames($anomaly)
	{
		$anomalousNames = DB::table('players')->where('name', 'LIKE', '%' . $anomaly . '%')->get();

		//			$query->orWhere('name', 'LIKE', '%' . $criterion .'%');

		return View::make('show-anomalous-names', compact('anomalousNames', 'anomaly'));
	}

	public function deleteAnomalousNames($anomaly)
	{
		$anomalousNames = DB::table('players')->where('name', '=', $anomaly)->delete();

		return "$anomaly delorted";
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
	 * Find all players whose name matches a specific search query
	 *
	 * 
	 * @return Response
	 *
	 */
	public function search($searchQuery = null) {
		if (!$searchQuery)
			$searchQuery = Input::get('query');
			$results = Player::search($searchQuery);

			return View::make('search-results', compact('results'));	
	}

	public function getAllPlayersOfTeam() {
		$tottPlayers = [];
		foreach (Player::whereLastKnownTeam(6)->get() as $player) {
			//echo $player->name . "\n"
			array_push($tottPlayers, $player->name);
		}
		// write to a json file
		$jsonTottToFile = fopen('app/storage/tottPlayers.json', 'w');
		fwrite($jsonTottToFile, json_encode($tottPlayers));
		fclose($jsonTottToFile);
		return;
	}

	// hack to get the player average stats directly in js
    public function getNiceRatingSummary(){
        $id = Input::get('id');
        $stats =  Player::find($id)->ratingSummary;
        foreach( $stats as $name => $stat){
            $name = ucfirst($name);
            $stat = round($stat, 1);
        }
        return Response::json($stats, 200);
    }
}
