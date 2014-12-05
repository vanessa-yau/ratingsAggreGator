<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateSeedPlayersEnglishPremierLeague extends Migration {

	var $teamNames = [];


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		$football = Sport::whereName('football')->first();

		// read the json to be seeded
		$raw = File::get(storage_path() . '/PlayerEnglishPremierLeagueSeeder.json');
        $json = json_decode($raw, true);

        // use decoded json file, (if there is one provided)
        if ($json) {
            // add new league to league table
            if (! League::whereName('English Premier League')->count() ) {
                $league = League::create([
                    'name' => 'English Premier League',
                    'sport_id' => $football->id
                ]);
            }
            else {
            	// else, assign the league to <value> to we can use it
                $league = League::whereName('English Premier League')->first();
            }

            // array to hold teamNames from foreach loop so we can access
            // them for migrate rollback/down
            // put the array values into a text file, because we can't use globals
            // in migrations: http://stackoverflow.com/questions/10107296/php-global-array-not-working

            // add teams
            foreach ($json as $team) {
                // create team model
                if (! Team::whereName($team['name'])->count() )
                    $teamModel = Team::create([
                        'name' => $team['name'],
                        'last_known_league_id' => $league->id
                    ]);
                else {
                    $teamModel = Team::whereName($team['name'])->first();
                    $teamModel->last_known_league_id = $league->id;
                    $teamModel->save();
                }
                // here push the $team['name'] values into an array
                // that we can access
                array_push($this->teamNames, $team['name']);

                // uncomment for viewing teams inserted via a route
                //echo $team['name'] . "<br>";
                // foreach ($team['players'] as $player) {
                //     $values = array_only($player, ['name']);
                //     if ( array_key_exists('name', $values) && $values['name']) {
                //         $playerModel = $football->players()->create([
                //             'name' => $player['name'],
                //             'nationality' => $player['nat'],
                //             'height' => $player['height'],
                //             'weight' => $player['weight'],
                //             // carbon can convert this to
                //             // yyyy-mm-dd 
                //             // currently is dd-mm-yyyy   
                //             //'dob' => $player['dob'],
                //             'last_known_team' => $teamModel->id
                //         ]);
                //     } // end if
                // } // end foreach
	        } // end foreach
            print_r($this->teamNames);  
        } // end if
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// find the league
		$league = League::whereName('English Premier League');

		// Find the teams which are in the league
		foreach($this->teamNames as $teamName ) {
			var_dump($teamName);
			$team = Team::whereName( $teamName )->first();
			$team->delete();
		}
		// Vanessa's not convinced ^

		// delete players


		// delete the teams

		
		// then delete the league (that may have) been created
		$league->delete();
	}
} // end class	