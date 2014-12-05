<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateSeedPlayersItalianSerieA extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function getFile(){
	    // return read and decoded file.
	    return json_decode(File::get(storage_path() . '/italianSerieA.json'), true);   
	}

	public function up()
	{
		$teamNames = [];
		$football = Sport::whereName('football')->first();

		// read the json to be seeded
        $json = $this->getFile();

        // use decoded json file, (if there is one provided)
        if ($json) {
            // add new league to league table
            if (! League::whereName('Italian Serie A')->count() ) {
                $league = League::create([
                    'name' => 'Italian Serie A',
                    'sport_id' => $football->id,
                    'badge_image_url' => '/images/leagues/serieA.jpg'
                ]);
            }
            else {
            	// else, assign the league to <value> to we can use it
                $league = League::whereName('Italian Serie A')->first();
            }

            // add teams
            ( file_exists("/images/teamBadges/".$team['name'].".png") )
                ?   $teamBadge = "/images/teamBadges/".$team['name'].".png"
                :   $teamBadge = "/images/teamBadges/placeholder.png";

            foreach ($json as $team) {
                // create team model
                if (! Team::whereName($team['name'])->count() ) {
                    // check if the team badge exists if not use generic image badge
                    $teamModel = Team::create([
                        'name' => $team['name'],
                        'last_known_league_id' => $league->id,
                        'badge_image_url' => $teamBadge
                    ]);
                }
                else {
                    $teamModel = Team::whereName($team['name'])->first();
                    $teamModel->last_known_league_id = $league->id;
                    $teamModel->badge_image_url = $teamBadge;
                    $teamModel->save();
                }
                // here push the $team['name'] values into an array
                // that we can access
                array_push($teamNames, $team['name']);

                // uncomment for viewing teams inserted via a route
                //echo $team['name'] . "<br>";

                foreach ($team['players'] as $player) {
                    $values = array_only($player, ['name']);
                    if ( array_key_exists('name', $values) && $values['name']) {
                        $playerModel = $football->players()->create([
                            'name' => $player['name'],
                            'nationality' => $player['nat'],
                            'height' => $player['height'],
                            'weight' => $player['weight'],
                            // carbon can convert this to
                            // yyyy-mm-dd 
                            // currently is dd-mm-yyyy   
                            //'dob' => $player['dob'],
                            'last_known_team' => $teamModel->id
                        ]);
                    } // end if
                } // end foreach
	        } // end foreach
            print_r($teamNames);  
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
		$league = League::whereName('Italian Serie A')->first();

        //get file to reverse insertions.
        $json = $this->getFile();

		// Find the teams which are in the league
		foreach ($json as $team) {
            // if the team exists
            if ( Team::whereName($team['name'])->count() ){
                // and if team exists only in one league
                if(Team::whereName($team['name'])->first()->leagues()->count() > 1){
                //  disassociate team with said league
                    echo Team::whereName($team['name'])->first()->id;
                    
                } else {
                    // otherwise, the team is only in one league and can be safely deleted.
                    $team = Team::whereName($team['name'])->whereLastKnownLeagueId($league->id)->first();

                    $players = Player::whereLastKnownTeam($team->id)->get();
                    foreach($players as $player){
                        // if a player is in any of the teams just deleted, disassociate them from the team.
                        $player->last_known_team = -1;
                        $player->save();
                        echo($player->name . "\n");
                    }

                    // finally delete team after players disassociated
                    $team->delete();
                    echo($team->name . " deleted ===========================================\n");
                } // end if
            } // end if
        } // end foreach
        // then delete the league (that may have) been created
        $league->delete();
	}
}
