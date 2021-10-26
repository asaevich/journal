<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'name' => 'Английского языка',
                'abbreviation' => 'АЯ',
                'faculty_id' => 5
            ],
            [
                'name' => 'Автоматизированных систем управления',
                'abbreviation' => 'АСУ',
                'faculty_id' => 5
            ],
            [
                'name' => 'Компьютерной инженерии',
                'abbreviation' => 'КИ',
                'faculty_id' => 5
            ],
            [
                'name' => 'Компьютерного моделирования и дизайна',
                'abbreviation' => 'КМД',
                'faculty_id' => 5
            ],
            [
                'name' => 'Программной инженерии',
                'abbreviation' => 'ПИ',
                'faculty_id' => 5
            ],
            [
                'name' => 'Искусственного интеллекта и системного анализа',
                'abbreviation' => 'ИИСА',
                'faculty_id' => 5
            ],
            [
                'name' => 'Прикладной математики',
                'abbreviation' => 'ПМ',
                'faculty_id' => 5
            ],
            [
                'name' => 'Экономической кибернетики',
                'abbreviation' => 'ЭК',
                'faculty_id' => 5
            ],
        ];

        DB::table('departments')->insert($data);
    }
}
