<?php
class SportTableSeeder extends Seeder {

    public function run()
    {
        //Delete existing table content
        DB::table('sports')->truncate();

        Sport::create(array(
            'name' => 'football',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
 
    }
}