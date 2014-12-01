<?php
class TeamTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content
        DB::table('teams')->truncate();

        //Open the file from the 'storage' subfolder in 'app' 
        $json = File::get(storage_path() . "\PlayerEnglishPremierLeagueSeeder.json");
        $data = json_decode($json);
        //Loop through all jSON objects and treat the name of each as a team
        foreach ($data as $object) {
            
            //Add the team into database
            Team::create(array ( 
                'name' => $object->name
            ));
        }
    }
}
