<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastKnownLeagueIdColToTeamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('teams', function($table)
		{
			// add sport_id col to table
			$table->integer('last_known_league_id');		
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('teams', function($table)
		{
			// drop sport_id col from the table
			$table->dropColumn('last_known_league_id');	
		});
	}

}
