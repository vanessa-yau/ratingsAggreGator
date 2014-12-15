<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTottenhamHotspurPlayerImages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// team, tottenham...
		$team = Team::whereName('Tottenham Hotspur')->first();
		// tottenham players
		$players = Player::whereLastKnownTeam($team->id)->get();
		
		// loop over the players, adding their images -> ids
		foreach ( $players as $player ) {
			// check if the playe image exists if not use placeholder
			( file_exists("./public/images/profile_images/".$player->id.".jpg") )
				?   $player->image_url = "/images/profile_images/".$player->id.".jpg"
				:   $player->image_url = "/images/profile_images/placeholder.png";
				// save each one
			$player->save();
		} // end for each
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// team, tottenham...
		$team = Team::whereName('Tottenham Hotspur')->first();
		// tottenham players
		$players = Player::whereLastKnownTeam($team->id)->get();
		
		// remove the badges
		foreach ( $players as $player ) {
			$player->image_url = "/images/profile_images/placeholder.png";
			$player->save();
		} // end for each
		// save each one
	} // end func
}
