<?php
class PlayerTableSeeder extends Seeder {

    public function run()
    {
        //Delete table content
        DB::table('players')->truncate();

        $data = [
            [
                'name' => 'Steven Gerrard',
                'nationality' => 'English',
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/1.jpg'
            ],
            [
                "name" => "Jake Davies",
                "nationality" => "Martian",
                "height" => "9001",
                "weight" => "9001",
                "dob" => "1989-02-07"
            ],
            [   
                "name" => "Érik Lamela",
                "nationality" => "Argentinian"
            ],
            [
                "name" => "Eric Dier",
                "nationality" => "English" 
            ],
            [
                "name" => "Paulinho",
                "nationality" => "Brazillian"
            ],
            [
                "name" => "Emmanuel Adebayor",
                "nationality" => "Togolese"
            ],
            [
                "name" => "Ryan Mason",
                "nationality" => "English"
            ],
            [
                "name" => "Christian Eriksen",
                "nationality" => "Danish"
            ],
            [
                "name" => "Roberto Soldado",
                "nationality" => "Spanish"
            ],
            [
                "name" => "Hugo Lloris",
                "nationality" => "French"
            ],
            [
                "name" => "Jan Vertonghen",
                "nationality" => "Belgian"
            ],
            [
                "name" => "Nacer Chadli",
                "nationality" => "Belgian"
            ],
            [
                "name" => "Harry Kane",
                "nationality" => "English"
            ]
        ];

        // find football
        $football = Sport::whereName('football')->first();

        foreach ($data as $datum) {
            $football
                ->players()
                ->create($datum);
        }

    }
}
