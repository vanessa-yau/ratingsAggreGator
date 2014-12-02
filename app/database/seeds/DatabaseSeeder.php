<?php

class DatabaseSeeder extends Seeder {

    /**
     * The order of these seeders is important.
     * A sport must be seeded before the player seeder can be called
     */
    public function run()
    {
        $this->call('SkillTableSeeder');
        $this->call('SportTableSeeder');
        // the old player seedle, only a few hard-coded players in here
        // $this->call('PlayerTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('RatingsTableSeeder');
        $this->call('RatingsProfileTableSeeder');
        $this->call('ProfileSkillTableSeeder');
        $this->call('TeamTableSeeder');
        $this->call('PlayerEnglishPremierLeagueSeeder');
    }

}