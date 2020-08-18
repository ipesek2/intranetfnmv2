<?php

use Illuminate\Database\Seeder;

class EnotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Enota::truncate();

        \App\Enota::create([
            'naziv' => 'Oddelek za MR',
            'vodja' => 1,
            'namestnik' => '2'
        ]);

        \App\Enota::create([
            'naziv' => 'Skupne službe',
            'vodja' => 2,
        ]);
    }
}
