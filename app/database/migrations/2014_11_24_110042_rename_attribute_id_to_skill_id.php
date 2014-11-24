<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAttributeIdToSkillId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('profile_skill', function($table)
		{
			// rename attribute_id in table profile_skill to skill_id
			$table->renameColumn('attributes', 'skill_id');
		});
	} // end func	

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// rename skill_id back to attribute_id
		Schema::table('profile_skill', function($table)
		{
			$table->renameColumn('skill_id', 'attributes');
		});
	} // end func
} // end class

