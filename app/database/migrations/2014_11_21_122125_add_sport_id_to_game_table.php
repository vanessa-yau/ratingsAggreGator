<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSportIdToGameTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::rename('game', 'games');
		Schema::table('games', function($table)
		{
			$table->integer('sport_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::rename('games', 'game');
		Schema::table('game', function($table)
		{
			$table->dropColumn('sport_id');
		});		
	}
} // end class
