<?php
class PlayerTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content
        DB::table('players')->delete();

        //Create new user
        Player::create(array(
                'id' => 1,
                'name' => 'Steven Gerrard',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
 
    }
}