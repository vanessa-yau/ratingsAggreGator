<?php
class RatingsProfileTableSeeder extends Seeder {

    public function run()
    {
        //Delete existing table content
        DB::table('ratings_profile')->truncate();

        RatingProfile::create(array(
            'name' => 'defender',
            'sport_id' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
 
    }
}