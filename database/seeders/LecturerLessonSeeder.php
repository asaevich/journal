<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerLessonSeeder extends Seeder
{
    public static function run()
    {
        /* ПАРЫ ЩЕДРИНА
        $data = [
            [
                'lecturer_id' => 1,
                'lesson_id' => 1
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 2
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 3
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 4
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 5
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 6
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 7
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 8
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 9
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 10
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 11
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 13
            ],
                /*
            [
                'lecturer_id' => 1,
                'lesson_id' => 14
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 15
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 16
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 17
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 18
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 19
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 20
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 21
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 22
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 23
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 24
            ],
            [
                'lecturer_id' => 1,
                'lesson_id' => 25
            ],
        ];
*/

        $data = [
            [
                'lecturer_id' => 5,
                'lesson_id' => 1
            ],
            [
                'lecturer_id' => 5,
                'lesson_id' => 2
            ],
            [
                'lecturer_id' => 5,
                'lesson_id' => 3
            ],
            [
                'lecturer_id' => 5,
                'lesson_id' => 4
            ],
            [
                'lecturer_id' => 5,
                'lesson_id' => 5
            ],
            [
                'lecturer_id' => 5,
                'lesson_id' => 6
            ],

            [
                'lecturer_id' => 1,
                'lesson_id' => 7
            ],
        ];

        DB::table('lecturer_lesson')->insert($data);
    }
}
