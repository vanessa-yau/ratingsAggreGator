<?php
class PlayerGermanBundesligaSeeder extends Seeder {

    public function run()
    {
        //Delete table content
        $football = Sport::whereName('football')->first();

        $raw = File::get(storage_path() . '/PlayerGermanBundesligaSeeder.json');
        $json = json_decode($raw, true);

        if ($json) {
            // add new league to league table
            if (! League::whereName('German Bundesliga')->count() ) {
                $league = League::create([
                    'name' => 'German Bundesliga',
                    'sport_id' => $football->id
                ]);
            }
            else {
                $league = League::whereName('German Bundesliga')->first();
            }

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
