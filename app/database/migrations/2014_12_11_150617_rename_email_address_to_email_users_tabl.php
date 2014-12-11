<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameEmailAddressToEmailUsersTabl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('users', function ($table)
		{
			// rename the columns
			$table->renameColumn('email_address', 'email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('users', function ($table)
		{
			// rename the columns
			$table->renameColumn('email', 'email_address');
		});
	}

}
