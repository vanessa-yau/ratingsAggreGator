<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('AttributeTableSeeder');
        $this->call('PlayerTableSeeder');
        $this->call('SportTableSeeder');
        $this->call('UserTableSeeder');
    }

}