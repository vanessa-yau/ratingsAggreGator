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
                'nationality' => 'English',
                'height' => 185,
                'weight' => 83,
                'dob' => '1980-05-30',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
 
    }
}