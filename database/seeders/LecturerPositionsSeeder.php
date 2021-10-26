<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerPositionsSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            ['position' => 'Аспирант'],
            ['position' => 'Ассистент'],
            ['position' => 'Ведущий научный сотрудник'],
            ['position' => 'Главный научный сотрудник'],
            ['position' => 'Докторант'],
            ['position' => 'Доцент'],
            ['position' => 'Младший научный сотрудник'],
            ['position' => 'Научный сотрудник'],
            ['position' => 'Преподаватель'],
            ['position' => 'Профессор'],
            ['position' => 'Старший преподаватель'],
            ['position' => 'Старший научный сотрудник']
        ];

        DB::table('lecturer_positions')->insert($data);
    }
}
