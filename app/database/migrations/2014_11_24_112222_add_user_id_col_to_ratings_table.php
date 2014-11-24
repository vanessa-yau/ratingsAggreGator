<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdColToRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('ratings', function($table)
		{
			// add user_id column to the table
			$table->integer('user_id');
		});
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ratings', function($table)
		{
			// remove the user_id col from the table
			$table->dropColumn('user_id');
		});
	} // end func 
} // end class
