<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LecturersSeeder extends Seeder
{
    public static function run()
    {
        $data = [
            [
                'last_name' => 'Щедрин',
                'first_name' => 'Сергей',
                'middle_name' => 'Валерьевич',
                'department_id' => 5,
                'position_id' => 2,
                'username' => 'shedrin',
                'password' => Hash::make('password'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'last_name' => 'Коломойцева',
                'first_name' => 'Ирина',
                'middle_name' => 'Александровна',
                'department_id' => 5,
                'position_id' => 11,
                'username' => 'kolomoiceva',
                'password' => Hash::make('password'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'last_name' => 'Ногтев',
                'first_name' => 'Евгений',
                'middle_name' => 'Александрович',
                'department_id' => 5,
                'position_id' => 2,
                'username' => 'nogtev',
                'password' => Hash::make('password'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'last_name' => 'Павлюк',
                'first_name' => 'Елена',
                'middle_name' => 'Николаевна',
                'department_id' => 5,
                'position_id' => 2,
                'username' => 'pavluk',
                'password' => Hash::make('password'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'last_name' => 'Филипишин',
                'first_name' => 'Дмитрий',
                'middle_name' => 'Александрович',
                'department_id' => 5,
                'position_id' => 2,
                'username' => 'filipishin',
                'password' => Hash::make('password'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
        ];

        DB::table('lecturers')->insert($data);
    }
}
