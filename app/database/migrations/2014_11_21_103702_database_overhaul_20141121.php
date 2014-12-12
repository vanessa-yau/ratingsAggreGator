<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseOverhaul20141121 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('attributes');
		Schema::create('skills', function($table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->timestamps();			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('skills');
		Schema::create('attributes', function($table)
		{
			$table->increments('id');
        	$table->string('skill', 100);
        	$table->timestamps();
		});
	}
} // close class	
