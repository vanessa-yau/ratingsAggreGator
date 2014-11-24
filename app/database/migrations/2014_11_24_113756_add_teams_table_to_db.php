<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamsTableToDb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// add teams table to database
		Schema::create('teams', function($table)
		{
			$table->integer('id');
			// name of the team
			$table->string('name');
		});
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// drop the table
		Schema::dropIfExists('teams');
	} // end func	
}
