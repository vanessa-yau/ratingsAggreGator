<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPortgueseTeamBadges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// dutch teams
		$league = League::whereName('Portuguese Primeira Liga')->first();
		$teams = Team::whereLastKnownLeagueId($league->id)->get();
		
		foreach ( $teams as $team ) {
			// check if the team badge exists if not use generic image badge
			( file_exists("./public/images/teamBadges/".$team->id.".png") )
				?   $team->badge_image_url = "/images/teamBadges/".$team->id.".png"
				:   $team->badge_image_url = "/images/teamBadges/placeholder.png";
				// save each one
			$team->save();
		} // end for each
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// dutch teams
		$league = League::whereName('Portuguese Primeira Liga')->first();
		$teams = Team::whereLastKnownLeagueId($league->id)->get();
		// remove the badges
		foreach ( $teams as $team ){
			$team->badge_image_url = "/images/teamBadges/placeholder.png";
			$team->save();
		} // end for each
		// save each one
	} // end func
}
