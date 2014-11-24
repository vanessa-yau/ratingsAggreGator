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
            'firstTouch',
            'freeKicks',
            'heading',
            'kicking',
            'marking',
            'pace',
            'passing',
            'preferredFoot',
            'saving',
            'shooting',
            'speed',
            'stamina',
            'strength',
            'tackling',
            'technique',
            'throwing',
            'workRate',
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
