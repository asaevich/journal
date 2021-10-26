<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmploymentTypesSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            ['type' => 'Ставка'],
            ['type' => 'Полставки'],
            ['type' => 'Почасовая']
        ];

        DB::table('employment_types')->insert($data);
    }
}
