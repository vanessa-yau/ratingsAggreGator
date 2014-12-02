<?php
class TestingPlayerTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content
        DB::table('ratings')->truncate();

        $skillIds = [];

        $data = [
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '1',
                'value' => '3',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '2',
                'value' => '3',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '3',
                'value' => '3',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '4',
                'value' => '3',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '5',
                'value' => '3',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '1',
                'value' => '1',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '2',
                'value' => '1',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '3',
                'value' => '1',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '4',
                'value' => '1',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'originating_ip' => '127.0.0.1',
                'player_id' => '1',
                'skill_id' => '5',
                'value' => '1',
                'game_id' => '1',
                'user_id' => '1',
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ]
        ];
        foreach ($data as $datum) {
            Rating::create($datum);
        } 
    }
}