<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BikeModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // fill the bike_models table with csv file data
        /* $file = fopen("database/seeders/bike_models.csv", "r");
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            DB::table('bike_models')->insert([
                'brand' => $data[0],
                'model' => $data[1],
                'power' => $data[2],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        */

        DB::table('bike_models')->insert([
            'brand' => 'Honda',
            'model' => 'CBR 500 R',
            'year' => 2019,
            'capacity' => 500,
            'category' => 'Sportive'
        ]);

        DB::table('bike_models')->insert([
            'brand' => 'Honda',
            'model' => 'CB 500 F',
            'year' => 2017,
            'capacity' => 500,
            'category' => 'Naked'
        ]);

        DB::table('bike_models')->insert([
            'brand' => 'Honda',
            'model' => 'CB 650 F',
            'year' => 2018,
            'capacity' => 649,
            'category' => 'Naked'
        ]);

        DB::table('bike_models')->insert([
            'brand' => 'Brixton',
            'model' => 'Felsberg 125 Scrambler',
            'year' => 2018,
            'capacity' => 125,
            'category' => '125'
        ]);

        DB::table('bike_models')->insert([
            'brand' => 'Kawasaki',
            'model' => 'Versys 650',
            'year' => 2020,
            'capacity' => 649,
            'category' => 'Touring'
        ]);

        DB::table('bike_models')->insert([
            'brand' => 'Kawasaki',
            'model' => 'Ninja 1000 SX',
            'year' => 2021,
            'capacity' => 1049,
            'category' => 'Sportive'
        ]);
    }
}
