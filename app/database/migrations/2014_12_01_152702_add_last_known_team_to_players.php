<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastKnownTeamToPlayers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// add the col
		Schema::table('players', function($table)
		{
			$table->integer('last_known_team');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('players', function($table)
		{
			// drop the col 
			$table->dropColumn('last_known_team');
		});
	} // end func
 } // end class
