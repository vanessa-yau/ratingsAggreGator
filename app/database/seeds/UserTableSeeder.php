<?php
class UserTableSeeder extends Seeder {

    public function run()
    {
        //reset 'Scrubwatch' user in database.
        $user = User::whereUsername("scrubwatch")->first();
        $user->username = 'scrubwatch';
        $user->first_name = 'Scrub';
        $user->surname = 'Watch';
        $user->password = '$2y$10$OniWZ/wrKV.9NMUim5Y/zeEVUnFusbM51LxpjxEr6ZGsqAjEusc72';
        $user->email = 'scrubwatch@domain.com';
        $user->country_code = 'GB';
        $user->city = 'Cardiff';
        $user->save();
    }
}