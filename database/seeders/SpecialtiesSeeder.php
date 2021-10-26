<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'name' => 'Программная инженерия',
                'abbreviation' => 'ПИ',
                'department_id' => 5
            ],
            [
                'name' => 'Системы автоматизированного проектирования',
                'abbreviation' => 'САПР',
                'department_id' => 5
            ],
        ];

        DB::table('specialties')->insert($data);
    }
}
