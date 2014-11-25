<?php
class SkillTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content and reset auto increment id to 1
        DB::table('skills')->truncate();

        //Insert new attributes listed below in alphabetic order
        // attributes for football

        $names = array(
            'aggression',
            'agility',
            'composure',
            'corners',
            'creativity',
            'crossing',
            'dribbling',
            'finishing',
            'first Touch',
            'free Kicks',
            'heading',
            'kicking',
            'marking',
            'pace',
            'passing',
            'preferred Foot',
            'saving',
            'shooting',
            'speed',
            'stamina',
            'strength',
            'tackling',
            'technique',
            'throwing',
            'work Rate',
        );

        foreach( $names as $name ){
            Skill::create(array(
                'name'         => $name,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ));
        }
    }
}
