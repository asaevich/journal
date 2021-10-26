<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'name' => 'Базы данных',
                'department_id' => 5
            ],
            [
                'name' => 'Введение в программирование .NET',
                'department_id' => 5
            ],
        ];

        DB::table('subjects')->insert($data);
    }
}
