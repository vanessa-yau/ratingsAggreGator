<?php
class SkillTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content and reset auto increment id to 1
        DB::table('skills')->truncate();

        //Insert new attributes listed below in alphabetic order
        // attributes for football

        $names = array(
            'agility',
            'composure',
            'dribbling',
            'kicking',
            'passing',
            'saving',
            'shooting',
            'speed',
            'strength',
            'tackling'
        );

        foreach( $names as $name){
            Skill::create(array(
                'name'          => $name,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ));
        }
    }
}