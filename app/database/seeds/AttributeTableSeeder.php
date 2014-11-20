<?php
class AttributeTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content and reset auto increment id to 1
        DB::table('attributes')->truncate();

        //Insert new attributes listed below in alphabetic order
        // attributes for football

        $attributes = array(
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

        foreach( $attributes as $attribute){
            Attribute::insert(array(
                'skill'         => $attribute,
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ));
        }
    }
}