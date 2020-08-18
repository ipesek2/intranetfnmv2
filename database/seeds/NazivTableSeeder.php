<?php

use Illuminate\Database\Seeder;

class NazivTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Naziv::truncate();

        \App\Naziv::create([
            'm_naziv' => 'asistent',
            'z_naziv' => 'asistentka',
            'kratek_naziv' => 'asist.'
            ]);

        \App\Naziv::create([
            'm_naziv' => 'docent',
            'z_naziv' => 'docentka',
            'kratek_naziv' => 'doc.'
        ]);

        \App\Naziv::create([
            'm_naziv' => 'izredni profesor',
            'z_naziv' => 'izredna profesorica',
            'kratek_naziv' => 'prof. dr.'
        ]);

        \App\Naziv::create([
            'm_naziv' => 'redni profesor',
            'z_naziv' => 'redna profesorica',
            'kratek_naziv' => 'prof. dr.'
        ]);

    }
}
