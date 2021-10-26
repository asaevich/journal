<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaysSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'holiday' => 'test',
                'start_date' => '2020-09-02',
                'end_date' => '2020-09-03'
            ],
            [
                'holiday' => '1 мая',
                'start_date' => '2021-05-05',
                'end_date' => '2021-05-05'
            ],
        ];

        DB::table('holidays')->insert($data);
    }
}
