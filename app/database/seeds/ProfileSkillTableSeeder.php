<?php
class ProfileSkillTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content
        DB::table('profile_skill')->truncate();

        //Create new profile->skill association.
        for ($i=0; $i < 5; $i++) { 
            DB::table('profile_skill')->insert([
                'rating_profile_id' => '1',
                'skill_id' => $i+1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ]);
        }
    }
}