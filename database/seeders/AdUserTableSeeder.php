<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdUserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // vincent aime la moto de titus et la mienne
        DB::table('ad_user')->insert([
            'user_id' => 3,
            'ad_id' => 2
        ]);
        DB::table('ad_user')->insert([
            'user_id' => 3,
            'ad_id' => 5
        ]);

        // Nico aime toutes les moto à 35 kw
        DB::table('ad_user')->insert([
            'user_id' => 2,
            'ad_id' => 2
        ]);
        DB::table('ad_user')->insert([
            'user_id' => 2,
            'ad_id' => 5
        ]);
        DB::table('ad_user')->insert([
            'user_id' => 2,
            'ad_id' => 6
        ]);
    }
}
