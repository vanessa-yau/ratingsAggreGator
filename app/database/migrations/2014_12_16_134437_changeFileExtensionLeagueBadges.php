<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFileExtensionLeagueBadges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// change jpgs to pngs

		// get all the leagues
		$leagues = League::all();

		foreach ($leagues as $league) { $league->badge_image_url = str_replace(".jpg", ".png", $league->badge_image_url); $league->save(); }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// change jpgs to pngs

		// get all the leagues
		$leagues = League::all();

		foreach ($leagues as $league) {
			$league->badge_image_url = str_replace(".png", ".jpg", $league->badge_image_url);
			$league->save();
		}
	}

}
