<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('sports', function($table)
	    {
	        $table->increments('id');
	        $table->string('name', 100);
	        $table->timestamps();
	    });
	}

	public function down()
	{
	    Schema::drop('ratings');
	}

}
