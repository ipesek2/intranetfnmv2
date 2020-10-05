<?php

use Illuminate\Database\Seeder;

class TipPrisotnostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TipPrisotnost::truncate();

        \App\TipPrisotnost::create([
            "naziv"=> "Doma"
        ]);

        \App\TipPrisotnost::create([
            "naziv"=> "Na fakulteti"
        ]);
    }
}
