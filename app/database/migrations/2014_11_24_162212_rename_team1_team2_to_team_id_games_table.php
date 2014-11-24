<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTeam1Team2ToTeamIdGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('games', function ($table)
		{
			// rename the columns
			$table->renameColumn('team1', 'team1_id');
			$table->renameColumn('team2', 'team2_id');
		});
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('games', function ($table)
		{
			// name them back to what they were
			$table->renameColumn('team1_id', 'team1');
			$table->renameColumn('team2_id', 'team2');
		});
	} // end func
} // end class

