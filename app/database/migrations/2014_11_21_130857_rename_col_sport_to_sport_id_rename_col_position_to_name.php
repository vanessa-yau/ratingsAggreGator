<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColSportToSportIdRenameColPositionToName extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ratings_profile', function($table)
		{	
			// rename to sport_id
			$table->renameColumn('sport', 'sport_id');
			// rename to name
			$table->renameColumn('position', 'name');
		});
	} // end func up	

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ratings_profile', function($table)
		{
			// rename it back to sport
			$table->renameColumn('sport_id', 'sport');
			// rename it back to position
			$table->renameColumn('name', 'position');
		});
	} // end func up
} // end class