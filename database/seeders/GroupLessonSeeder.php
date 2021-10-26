<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupLessonSeeder extends Seeder
{
    public static function run()
    {
        /*
        $data = [
            [
                'group_id' => 3,
                'lesson_id' => 1
            ],
            [
                'group_id' => 1,
                'lesson_id' => 2
            ],
            [
                'group_id' => 2,
                'lesson_id' => 2
            ],
            [
                'group_id' => 3,
                'lesson_id' => 2
            ],
            [
                'group_id' => 6,
                'lesson_id' => 3
            ],
            [
                'group_id' => 5,
                'lesson_id' => 4
            ],
            [
                'group_id' => 2,
                'lesson_id' => 5
            ],
            [
                'group_id' => 6,
                'lesson_id' => 6
            ],
            [
                'group_id' => 4,
                'lesson_id' => 7
            ],
            [
                'group_id' => 5,
                'lesson_id' => 8
            ],
            [
                'group_id' => 1,
                'lesson_id' => 9
            ],
            [
                'group_id' => 2,
                'lesson_id' => 10
            ],
            [
                'group_id' => 7,
                'lesson_id' => 11
            ],
            [
                'group_id' => 4,
                'lesson_id' => 12
            ]
        ];
        */

        $data = [
            [
                'group_id' => 3,
                'lesson_id' => 1
            ],
            [
                'group_id' => 1,
                'lesson_id' => 2
            ],
            [
                'group_id' => 1,
                'lesson_id' => 3
            ],
            [
                'group_id' => 2,
                'lesson_id' => 4
            ],
            [
                'group_id' => 3,
                'lesson_id' => 5
            ],
            [
                'group_id' => 2,
                'lesson_id' => 6
            ],

            [
                'group_id' => 2,
                'lesson_id' => 7
            ],
        ];

        DB::table('group_lesson')->insert($data);
    }
}
