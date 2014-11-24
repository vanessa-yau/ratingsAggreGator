<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUserIdAi extends Migration {

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
		Schema::table('users', function($table)
		{
			// drop the col first
			$table->dropColumn('id');
			
		});

		Schema::table('users', function($table)
		{
			// make id AI, recreate col	
			$table->increments('id');
		});	
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			// drop the (ai) col
			$table->dropColumn('id');
		});

		Schema::table('users', function($table)
		{
			// create col as it was, non-ai
			$table->integer('id');
		});	
	} // end func
} // end class
