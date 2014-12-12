<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEngChampBadges2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// english championship teams
		$league = League::whereName('English Football League Championship')->first();
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
		$league = League::whereName('English Football League Championship')->first();
		$teams = Team::whereLastKnownLeagueId($league->id)->get();

		// english championship teams
		// remove the badges
		foreach ( $teams as $team ){
			$team->badge_image_url = "/images/teamBadges/placeholder.png";
			$team->save();
		} // end for each
		// save each one
	} // end func
}
