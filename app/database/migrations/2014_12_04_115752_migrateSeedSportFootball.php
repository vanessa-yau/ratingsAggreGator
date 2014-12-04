<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateSeedSportFootball extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// add football as Sport value (if not found)
		if (!Sport::whereName('football')) {
			$football = Sport::create([
				'name' => 'football'
			]);
		} // end if
	} // end func
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// if football is found, delete it
		if (Sport::whereName('football')) {
			$football = Sport::whereName('football');
			$football->delete();
		} // end if
	} // end func
} // end class
