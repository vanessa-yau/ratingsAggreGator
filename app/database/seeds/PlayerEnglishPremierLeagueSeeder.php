<?php
class PlayerEnglishPremierLeagueSeeder extends Seeder {

    public function run()
    {
        // Truncate table content, removes duplicate entries
-       DB::table('players')->truncate();

        $football = Sport::whereName('football')->first();

        $raw = File::get(storage_path() . '/PlayerEnglishPremierLeagueSeeder.json');
        $json = json_decode($raw, true);

        if ($json) {
            // add new league to league table
            if (! League::whereName('English Premier League')->count() ) {
                $league = League::create([
                    'name' => 'English Premier League',
                    'sport_id' => $football->id
                ]);
            }
            else {
                $league = League::whereName('English Premier League')->first();
            }

            // add teams
            foreach ($json as $team) {

                // create team model
                if (! Team::whereName($team['name'])->count() )
                    $teamModel = Team::create([
                        'name' => $team['name'],
                        'last_known_league_id' => $league->id
                    ]);
                else {
                    $teamModel = Team::whereName($team['name'])->first();
                    $teamModel->last_known_league_id = $league->id;
                    $teamModel->save();
                }

                // uncomment for viewing teams inserted via a route
                //echo $team['name'] . "<br>";
                foreach ($team['players'] as $player) {
                    $values = array_only($player, ['name']);
                    if ( array_key_exists('name', $values) && $values['name']) {
                        $playerModel = $football->players()->create([
                            'name' => $player['name'],
                            'last_known_team' => $teamModel->id
                        ]);
                    } // end if
                } // end foreach
            } // end foreach
        } // end if
    } // end func
} // end class


