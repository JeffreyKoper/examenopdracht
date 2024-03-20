<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => "Jeffrey Koper",
                'email' => "jeffrey.koper@hotmail.com",
                'password' => hash::make('testwachtwoord'),
                'role' => "admin",
            ],
            [
                'username' => "nika Mancev",
                'email' => "nicha.work@outlook.com",
                'password' => hash::make('LegendOfZelda'),
                'role' => "user",
            ]
            ];
            
            DB::table('users')->insert($users);
    }
}
