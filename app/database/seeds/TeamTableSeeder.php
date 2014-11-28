<?php
class TeamTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content
        DB::table('teams')->truncate();

        //Open the file from the 'storage' subfolder in 'app' 
        $jSon = File::get(storage_path() . "/data.txt");
        $player = json_decode($jSon);
        //Loop through all jSON objects and treat the name of each as a team
        foreach ($team as $object) {
            //Add the team into database
            Team::create(array ( 
                'name' => $object->name,
            ));
        }
    }
}
