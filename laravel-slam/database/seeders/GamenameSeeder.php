<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamenameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gamename')->insert([
            ['Id' => 1, 'NomJeu' => 'BlackJack'],
            ['Id' => 2, 'NomJeu' => 'Shifumi'],
            ['Id' => 3, 'NomJeu' => 'Pile ou Face'],
        ]);
    }
}