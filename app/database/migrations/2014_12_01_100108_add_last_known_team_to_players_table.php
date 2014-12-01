<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastKnownTeamToPlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// column to hold last known team player played for 
		// nb: per game basis, if player added from 'fresh', via seeder
		Schema::table('players', function($table)
		{
			$table->string('last_known_team');
		});
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// remove the column
		Schema::table('players', function($table)
		{
			$table->dropColumn('last_known_team');
		});	
	} // end func
} // end class
