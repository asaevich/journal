<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransfersSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'lesson_id' => '1',
                'old_date' => '2021-02-08',
                'new_date' => '2021-02-10'
            ],
            [
                'lesson_id' => '2',
                'old_date' => '2021-02-08',
                'new_date' => '2021-02-10'
            ],
        ];

        DB::table('transfers')->insert($data);
    }
}
