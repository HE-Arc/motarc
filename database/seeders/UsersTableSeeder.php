<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Titus',
            'email' => 'titus.abele@he-arc.ch',
            'password' => Hash::make('titus123'),
            'npa' => 2000
        ]);

        DB::table('users')->insert([
            'name' => 'Nico',
            'email' => 'nicolas.aubert@he-arc.ch',
            'password' => Hash::make('nico1234'),
            'npa' => 2300
        ]);

        DB::table('users')->insert([
            'name' => 'Vinz',
            'email' => 'vincent.jeannin@he-arc.ch',
            'password' => Hash::make('vinz1234'),
            'npa' => 2022
        ]);

        DB::table('users')->insert([
            'name' => 'Jeanne',
            'email' => 'jeanne.michel@he-arc.ch',
            'password' => Hash::make('jeanne12'),
            'npa' => 2353
        ]);

        DB::table('users')->insert([
            'name' => 'Jonas',
            'email' => 'jonas.allemann@he-arc.ch',
            'password' => Hash::make('jonas123'),
            'npa' => 2353
        ]);
    }
}
