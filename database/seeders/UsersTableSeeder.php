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
            'name' => 'Test User 1',
            'email' => 'test1@test.ch',
            'password' => Hash::make('password1'),
            'npa' => 1111
        ]);

        DB::table('users')->insert([
            'name' => 'Test User 2',
            'email' => 'test2@test.ch',
            'password' => Hash::make('password2'),
            'npa' => 2222
        ]);
    }
}
