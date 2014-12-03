<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	public function up()
	{
		Schema::create('users', function($table)
	    {
	        $table->increments('id');
	        $table->string('first_name', 40);
	        $table->string('surname', 40);
	        $table->string('username', 100);
	        $table->string('password');
	        $table->string('email_address');
	        $table->string('country_code');
	        $table->string('city');
	        $table->timestamps();
	    });
	}

	public function down()
	{
		Schema::drop('users');
	}

}
