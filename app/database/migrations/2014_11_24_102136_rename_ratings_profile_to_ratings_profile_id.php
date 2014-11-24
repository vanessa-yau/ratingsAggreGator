<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameRatingsProfileToRatingsProfileId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('profile_skill', function($table)
		{
			// rename to ratings_profile_id
			$table->renameColumn('rating_profile', 'rating_profile_id');
		});
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('profile_skill', function($table)
		{
		// rename it back to ratings_profile
		$table->renameColumn('rating_profile_id', 'rating_profile');
		});
	} // end func
} // end class	
