<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('ratings', function($table)
	    {
	        $table->increments('id');
	        $table->integer('player_id');
	        $table->string('attribute', 100);
	        $table->integer('game_id');
	        $table->integer('value');
	        $table->timestamps();
	    });
	}

	public function down()
	{
	    Schema::drop('ratings');
	}

}
