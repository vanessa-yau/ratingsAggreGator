<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTeamIdAi extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	/* JD: I have created seperated functions because
			drop col and then creating it are done with 1
			transaction. Splitting in 2 solves this */
	public function up()
	{
		Schema::table('teams', function($table)
		{
			// drop the col first
			$table->dropColumn('id');
		});

		Schema::table('teams', function($table)
		{
			// make id AI, recreate col
			$table->increments('id');
		});
		//
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
			// drop the (ai) col
			$table->dropColumn('id');
		});	

		Schema::table('teams', function($table)
			// create col as it was, non-ai
			$table->integer('id');
		});	
	} // end func
} // end class
