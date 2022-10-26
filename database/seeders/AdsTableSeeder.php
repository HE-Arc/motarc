<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vincent Kawasaki Ninja 1000 SX
        DB::table('ads')->insert([
            'price' => 14000,
            'km' => 9850,
            'power_kw' => 104.5,
            'color_hexa' => 'green',
            'model_id' => 6,
            'user_id' => 13,
        ]);

        // Titus Kawasaki Versys 650
        DB::table('ads')->insert([
            'price' => 6500,
            'km' => 16800,
            'power_kw' => 35,
            'color_hexa' => 'white',
            'model_id' => 5,
            'user_id' => 11,
        ]);

        // Nico Brixton Flesberg
        DB::table('ads')->insert([
            'price' => 2200,
            'km' => 11000,
            'power_kw' => 8.2,
            'color_hexa' => 'black',
            'model_id' => 4,
            'user_id' => 12,
        ]);

        // Jonas CB 650 F
        DB::table('ads')->insert([
            'price' => 5000,
            'km' => 18000,
            'power_kw' => 67,
            'color_hexa' => 'red',
            'model_id' => 3,
            'user_id' => 15,
        ]);

        // Jeanne CBR 500 R
        DB::table('ads')->insert([
            'price' => 6000,
            'km' => 10000,
            'power_kw' => 35,
            'color_hexa' => 'red',
            'model_id' => 1,
            'user_id' => 14,
        ]);

        // Jeanne CB 500 F
        DB::table('ads')->insert([
            'price' => 5000,
            'km' => 28000,
            'power_kw' => 35,
            'color_hexa' => 'white',
            'model_id' => 2,
            'user_id' => 14,
        ]);
    }
}
