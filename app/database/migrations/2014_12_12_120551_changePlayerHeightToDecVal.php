<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePlayerHeightToDecVal extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// change height to float
	    DB::statement('ALTER TABLE players MODIFY COLUMN height FLOAT');
	}

	public function down()
	{
	    DB::statement('ALTER TABLE players MODIFY COLUMN height INT');
	}
}   