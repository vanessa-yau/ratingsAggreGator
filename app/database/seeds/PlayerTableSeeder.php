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
                "dob" => "1989-02-07",
                'image_url' => ''
            ],
            [   
                "name" => "Érik Lamela",
                "nationality" => "Argentinian",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/3.jpg'
            ],
            [
                "name" => "Eric Dier",
                "nationality" => "English",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/4.jpg'
            ],
            [
                "name" => "Paulinho",
                "nationality" => "Brazillian",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/5.jpg'
            ],
            [
                "name" => "Emmanuel Adebayor",
                "nationality" => "Togolese",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/6.jpg'
            ],
            [
                "name" => "Ryan Mason",
                "nationality" => "English",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/7.jpg'
            ],
            [
                "name" => "Christian Eriksen",
                "nationality" => "Danish",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/8.jpg'
            ],
            [
                "name" => "Roberto Soldado",
                "nationality" => "Spanish",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/9.jpg'
            ],
            [
                "name" => "Hugo Lloris",
                "nationality" => "French",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/10.jpg'
            ],
            [
                "name" => "Jan Vertonghen",
                "nationality" => "Belgian",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/11.jpg'
            ],
            [
                "name" => "Nacer Chadli",
                "nationality" => "Belgian",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/12.jpg'
            ],
            [
                "name" => "Harry Kane",
                "nationality" => "English",
                'height' => '185',
                'weight' => '83',
                'dob' => '1980-05-30',
                'image_url' => '/images/profile_images/13.jpg'
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
