<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReplacementsSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'lesson_id' => 7,
                'lesson_date' => '2021-02-08',
                'semester_id' => 2,
                'old_lecturer_id' => '1',
                'new_lecturer_id' => '5',
            ],
        ];

        DB::table('replacements')->insert($data);
    }
}
