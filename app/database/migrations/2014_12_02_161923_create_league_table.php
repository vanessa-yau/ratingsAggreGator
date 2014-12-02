<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueTable extends Migration {

	public function up()
	{
		Schema::create('leagues', function($table)
	    {
	        $table->increments('id');
	        $table->integer('sport_id');
	        $table->string('name', 100);
	        $table->timestamps();
	    });
	}

	public function down()
	{
		Schema::drop('leagues');
	}

}
