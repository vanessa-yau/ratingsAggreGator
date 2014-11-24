<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAttributeToSkillIdInRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// rename attribute col in ratings table to skill_id
		Schema::table('ratings', function($table)
		{
			// rename attribute column to skill_id
			$table->renameColumn('attribute', 'skill_id');
		});	
	} // end func

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// rename skill_id back to attribute
		Schema::table('ratings', function($table)
		{
			// rename col attribute to skill_id
			$table->renameColumn('skill_id', 'attribute');
		});
	} // end func
} // end class
