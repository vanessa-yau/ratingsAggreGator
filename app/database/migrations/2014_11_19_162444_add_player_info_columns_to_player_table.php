<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlayerInfoColumnsToPlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('players', function($table)
		{
		    $table->string('nationality');
		    $table->date('dob');
		    $table->integer('height');
		    $table->integer('weight');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	  $table->dropColumn('nationality');
	  $table->dropColumn('dob');
	  $table->dropColumn('height');
	  $table->dropColumn('weight');
	}

}
