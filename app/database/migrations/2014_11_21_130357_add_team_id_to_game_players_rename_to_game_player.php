<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamIdToGamePlayersRenameToGamePlayer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::rename('game_players', 'game_player');
		Schema::table('game_player', function($table)
		{	
			// add a col
			$table->integer('team_id');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::rename('game_player', 'game_players');
		Schema::table('game_players', function($table)
		{
			// drop a col
			$table->dropColumn('team_id');
		});	
	}
} // end class
