<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableProfileAttributesToProfileSkill extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// rename TABLE profile_attributes to profile_skill
		Schema::rename('profile_attributes', 'profile_skill');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// rename it back to what it was
		Schema::rename('profile_skill', 'profile_attributes');
	}
} // end class
