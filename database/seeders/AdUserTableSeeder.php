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
            'ad_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('ad_user')->insert([
            'user_id' => 3,
            'ad_id' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Nico aime toutes les moto à 35 kw
        DB::table('ad_user')->insert([
            'user_id' => 2,
            'ad_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('ad_user')->insert([
            'user_id' => 2,
            'ad_id' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('ad_user')->insert([
            'user_id' => 2,
            'ad_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
