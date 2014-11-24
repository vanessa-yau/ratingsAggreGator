<?php
class PlayerTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content
        DB::table('players')->truncate();

        foreach (['Gerrard', 'Reilly', 'Blamey', 'Baldrick', 'Flintstone', 'Russell', 'Woodhouse', 'Perkins', 'Thompson'] as $surname)
        {
            //Create new user
            Player::create(array(
                    'name' => 'Steven ' . $surname,
                    'nationality' => 'English',
                    'height' => '185',
                    'weight' => '83',
                    'dob' => '1980-05-30',
                    'created_at' => new DateTime,
                    'updated_at' => new DateTime,
                    'image_url' => '/images/profile_images/1.jpg'
            ));
        }
 
    }
}