<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultiesSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'name' => 'Горный',
                'abbreviation' => 'ГФ'
            ],
            [
                'name' => 'Инженерно-экономический',
                'abbreviation' => 'ИЭФ'
            ],
            [
                'name' => 'Инженерной механики и машиностроения',
                'abbreviation' => 'ФИММ'
            ],
            [
                'name' => 'Компьютерных информационных технологий и автоматики',
                'abbreviation' => 'ФКИТА'
            ],
            [
                'name' => 'Компьютерных наук и технологий',
                'abbreviation' => 'ФКНТ'
            ],
            [
                'name' => 'Металлургии и теплоэнергетики',
                'abbreviation' => 'ФМТ'
            ],
            [
                'name' => 'Недропользования и наук о Земле',
                'abbreviation' => 'ФННЗ'
            ],
            [
                'name' => 'Экологии и химической технологии',
                'abbreviation' => 'ФЭХТ'
            ],
            [
                'name' => 'Элетротехнический',
                'abbreviation' => 'ЭФ'
            ]
        ];

        DB::table('faculties')->insert($data);
    }
}
