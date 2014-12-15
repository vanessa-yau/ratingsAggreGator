<?php

class DatabaseSeeder extends Seeder {

    /**
     * The order of these seeders is important.
     * A sport must be seeded before the player seeder can be called
     */
    public function run()
    {
        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // JD:
        // Never run db:seed without a --class=<seederClassName> specified
        // that's why all these are commented out
        // and are now merely for reference
        // To run, uncomment one, then do 
        // db:seed --class=<seederClassName> 
        // then comment it, and move onto the next one
        // If you mess up, you'll need to add a truncate 
        // option to the seeder method to remove any duplicates
        // some example searches:
        // epl: 'gerrard'
        // ger: 'ochs'
        // ita: 'domizzi'
        // esp: 'ronaldo'
        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


        $this->call('SkillTableSeeder');
        // $this->call('SportTableSeeder');
        //the old player seedle, only a few hard-coded players in here
        //$this->call('PlayerTableSeeder');
        // $this->call('UserTableSeeder');
        // $this->call('RatingsTableSeeder');
        $this->call('RatingsProfileTableSeeder');
        $this->call('ProfileSkillTableSeeder');
        // $this->call('TeamTableSeeder');
        // below are the teams to seed, which you un/comment out each time
        // see the docs/comment above
        // $this->call('PlayerEnglishPremierLeagueSeeder');
        // $this->call('PlayerSpanishLaLigaSeeder');
        // $this->call('PlayerGermanBundesligaSeeder');
        // $this->call('PlayerItalianSerieaSeeder');
        // $this->call('PlayerFrenchLigue1Seeder');
        // $this->call('PlayerPortuguesePrimeiraLigaSeeder');       
        //$this->call('TestingPlayerTableSeeder');
    }
}