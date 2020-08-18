<?php

use Illuminate\Database\Seeder;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\UserProfile::truncate();

        \App\UserProfile::create([
            'user_id' => 1,
            'ime' => 'Igor',
            'priimek' => 'Pesek',
            'naziv_id' => 2,
            'enota_id' => 1,
            'spol' => 1,
            'aktiven' => 1,
            'potrjevanje'=>0
        ]);

        \App\UserProfile::create([
            'user_id' => 2,
            'ime' => 'Monika',
            'priimek' => 'Šket',
            'naziv_id' => 3,
            'enota_id' => 1,
            'spol' => 2,
            'aktiven' => 1,
            'potrjevanje'=>0
        ]);

    }
}
