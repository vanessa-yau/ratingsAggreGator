<?php

class PlayerController extends \BaseController {

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

		return View::make('player-profile', compact('player', 'skills' ,'team', 'league'));
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
	public function search($searchQuery) {

		//Call the search function in the Player model

		// if ($searchQuery == null || $searchQuery =="") {
		// 	return Redirect::back();
		// }
		// else {
			$results = Player::search($searchQuery);
			return View::make('search-results', compact('results'));
		// }
		
	}

	// returns a random selection of players
	public function getRandomPlayers() {
		$totalNumPlayers = Player::all()->count();
		$randomPlayerIds = [];

		for( $i=0 ; $i<10 ; $i++ ){
			array_push( $randomPlayerIds, rand(1, $totalNumPlayers) );
		}

		return Player::whereIn('id', $randomPlayerIds)->get();
	}
}
