<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationTypesSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            ['type' => 'Очное'],
            ['type' => 'Заочное'],
            ['type' => 'Очно-заочное']
        ];

        DB::table('education_types')->insert($data);
    }
}
