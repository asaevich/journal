<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'number' => 1,
                'start_education_year' => 2020,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-30',
            ],
            [
                'number' => 2,
                'start_education_year' => 2020,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-04',
            ],
        ];

        DB::table('semesters')->insert($data);
    }
}
