<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavouritesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // vincent aime la moto de titus et la mienne
        DB::table('favourites')->insert([
            'user_id' => 13,
            'ad_id' => 14
        ]);
        DB::table('favourites')->insert([
            'user_id' => 13,
            'ad_id' => 17
        ]);

        // Nico aime toutes les moto à 35 kw
        DB::table('favourites')->insert([
            'user_id' => 12,
            'ad_id' => 14
        ]);
        DB::table('favourites')->insert([
            'user_id' => 12,
            'ad_id' => 17
        ]);
        DB::table('favourites')->insert([
            'user_id' => 12,
            'ad_id' => 18
        ]);
    }
}
