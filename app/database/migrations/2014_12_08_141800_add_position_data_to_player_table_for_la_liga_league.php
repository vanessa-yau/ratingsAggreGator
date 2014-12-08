<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionDataToPlayerTableForLaLigaLeague extends Migration {

	public function getFile(){
        // return read and decoded file.
        $raw = File::get(storage_path() . '/spanishLaLigaScraper.json');
        return json_decode($raw, true);
    }

	/**
	 * Run the migrations.
	 * Warning: assumes that the league and teams exist in the database
	 *
	 * @return void
	 */
	public function up()
	{
		// read the json to be seeded
        $json = $this->getFile();

        // use decoded json file, (if there is one provided)
        if ($json) {
            // get the player entry from the database via player name and the league, teams
            $league = League::whereName('Spanish La Liga')->first();

            // loop though the existing teams
            foreach ($json as $jsonTeam) {
            	// since teams are unique, grab first team
            	$team = Team::whereName($jsonTeam['name'])->first();
            	echo "updating: ".$team;
                foreach ($jsonTeam['players'] as $jsonPlayer) {
                	// check if webscraper has player name listed
                	if( array_key_exists('name',$jsonPlayer) ){
		                // only update if not a null entry
	                	if( $jsonPlayer['name'] != "" && $jsonPlayer['name'] != "Name" ){
			                // find the player via the name and team id
			                // assumes a player can be uniquely identified by team_id and player_name
			                $player = Player::whereName( $jsonPlayer['name'] )
			                			->whereLastKnownTeam( $team->id )
			                			->first();

			                // set the player->position to match that in the json
			               	if ( !($jsonPlayer['pos'] == "" || $jsonPlayer['pos'] == "Pos") ){
			               		$player->position = $jsonPlayer['pos'];
			               		$player->save();
			               	}

			               	echo "position is ".$jsonPlayer['pos']." for ".$player->name."\n";
		               	} // end if
                	} // end if
            	} // end foreach
            	echo "\n";
            } // end foreach
        } // end if
	} // end func


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// read the json to be seeded
        $json = $this->getFile();

        // use decoded json file, (if there is one provided)
        if ($json) {
            // get the player entry from the database via player name and the league, teams
            $league = League::whereName('Spanish La Liga')->first();

            // loop though the existing teams
            foreach ($json as $jsonTeam) {
            	// since teams are unique, grab first team
            	$team = Team::whereName($jsonTeam['name'])->first();

                foreach ($jsonTeam['players'] as $jsonPlayer) {
                	// check if webscraper has player name listed
                	if( array_key_exists('name',$jsonPlayer) ){
	                	// only update if not a null entry
	                	if( $jsonPlayer['name'] != "" && $jsonPlayer['name'] != "Name" ){
			                // find the player via the name and team id
			                // also use height in case of multiple 
			                $player = Player::whereName( $jsonPlayer['name'] )
			                			->whereLastKnownTeam( $team->id )
			                			->first();

			                // // set the player->position to be blank
		               		$player->position = "";
		               		$player->save();

			               	echo "position is ".$jsonPlayer['pos']." for ".$player->name."\n";
	                	} // end if
                	} // end if
            	} // end foreach
            	echo "\n";
            } // end foreach
        } // end if
	} // end func

}
