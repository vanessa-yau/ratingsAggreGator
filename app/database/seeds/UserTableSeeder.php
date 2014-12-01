<?php
class UserTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content
        DB::table('users')->truncate();

        //Create new user
        User::create(array(
           // don't expose these values
            'username' => 'scrubwatch',
            'password' => Hash::make('pass1'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}