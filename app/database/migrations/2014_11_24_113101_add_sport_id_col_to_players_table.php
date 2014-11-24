<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSportIdColToPlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('players', function($table)
		{
			// add sport_id col to table
			$table->integer('sport_id');		
		});	
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('players', function($table)
		{
			// drop sport_id col from the table
			$table->dropColumn('sport_id');	
		});	
	} // end func
} // end class
