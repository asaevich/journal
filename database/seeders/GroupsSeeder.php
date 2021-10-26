<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsSeeder extends Seeder
{
    public static function run()
    {
        /*
        $data = [
            [
                'specialty_id' => 1,
                'subgroup' => 'а',
                'education_type_id' => 1,
                'admission_year' => 2019
            ],
            [
                'specialty_id' => 1,
                'subgroup' => 'б',
                'education_type_id' => 1,
                'admission_year' => 2019
            ],
            [
                'specialty_id' => 1,
                'subgroup' => 'в',
                'education_type_id' => 1,
                'admission_year' => 2019
            ],
            [
                'specialty_id' => 1,
                'subgroup' => 'а',
                'education_type_id' => 1,
                'admission_year' => 2020
            ],
            [
                'specialty_id' => 1,
                'subgroup' => 'б',
                'education_type_id' => 1,
                'admission_year' => 2020
            ],
            [
                'specialty_id' => 1,
                'subgroup' => 'в',
                'education_type_id' => 1,
                'admission_year' => 2020
            ],
            [
                'specialty_id' => 2,
                'subgroup' => null,
                'education_type_id' => 1,
                'admission_year' => 2017
            ],
        ];
*/

        $data = [
            [
                'specialty_id' => 1,
                'subgroup' => 'в',
                'education_type_id' => 1,
                'admission_year' => 2017
            ],
            [
                'specialty_id' => 1,
                'subgroup' => 'б',
                'education_type_id' => 1,
                'admission_year' => 2019
            ],
            [
                'specialty_id' => 1,
                'subgroup' => 'в',
                'education_type_id' => 1,
                'admission_year' => 2019
            ],
        ];

        DB::table('groups')->insert($data);
    }
}
