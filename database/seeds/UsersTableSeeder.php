<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();

        \App\User::create([
            'email' => 'skrbnik.fnm2@um.si',
            'password' => bcrypt('intranet'),
        ]);

        \App\User::create([
            'email' => 'monika.sket@um.si',
            'password' => bcrypt('intranet'),
        ]);
    }
}
