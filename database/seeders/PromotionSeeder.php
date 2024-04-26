<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = [
            [
                'code' => "LinkIsCool",
                'percentage' => 30,
                'uses' => 100,
                'valid' => 1,
            ],
            [
                'code' => "SpecialOffer",
                'percentage' => 20,
                'uses' => 50,
                'valid' => 1,
            ],
            [
                'code' => "LimitedTime",
                'percentage' => 25,
                'uses' => 0, // Set uses to 0
                'valid' => 1,
            ],
            [
                'code' => "ExpiredCode",
                'percentage' => 15,
                'uses' => 10,
                'valid' => 0, // Set as invalid
            ],
            [
                'code' => "SPRINGSALE20",
                'percentage' => 20,
                'uses' => 10000,
                'valid' => 1,
            ]

        ];
        DB::table('promotions')->insert($promotions);
    }
}
