<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditoriumsSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'building_number' => 5,
                'auditorium_number' => 429
            ],
            [
                'building_number' => 8,
                'auditorium_number' => 708
            ],
            [
                'building_number' => 4,
                'auditorium_number' => 01
            ],
            [
                'building_number' => 4,
                'auditorium_number' => 10
            ],
            [
                'building_number' => 5,
                'auditorium_number' => 432
            ],
            [
                'building_number' => 5,
                'auditorium_number' => 426
            ],
            [
                'building_number' => 5,
                'auditorium_number' => 434
            ]
        ];

        DB::table('auditoriums')->insert($data);
    }
}
