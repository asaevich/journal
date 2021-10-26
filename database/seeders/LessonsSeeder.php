<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsSeeder extends Seeder
{
    public static function run()
    {
        /* ПАРЫ ЩЕДРИНА
        $data = [
            // 1 семестр
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-11-01',
                'week_day' => 'Mon',
                'week_type' => 'up',
                'number' => 3
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Tue',
                'week_type' => 'up',
                'number' => 3
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 2,
                'lesson_type_id' => 1,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Tue',
                'week_type' => 'down',
                'number' => 3
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 3,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Tue',
                'week_type' => 'always',
                'number' => 4
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Tue',
                'week_type' => 'always',
                'number' => 5
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 1,
                'auditorium_id' => 3,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Wed',
                'week_type' => 'down',
                'number' => 1
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Wed',
                'week_type' => 'down',
                'number' => 3
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Thu',
                'week_type' => 'up',
                'number' => 4
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Thu',
                'week_type' => 'down',
                'number' => 4
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Thu',
                'week_type' => 'always',
                'number' => 5
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 3,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Fri',
                'week_type' => 'up',
                'number' => 1
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 5,
                'lesson_type_id' => 1,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Fri',
                'week_type' => 'always',
                'number' => 2
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2020-09-01',
                'end_date' => '2020-12-29',
                'week_day' => 'Fri',
                'week_type' => 'always',
                'number' => 4
            ],

            // 2 семестр
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Tue',
                'week_type' => 'up',
                'number' => 3
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 2,
                'lesson_type_id' => 1,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Tue',
                'week_type' => 'down',
                'number' => 3
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 3,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Tue',
                'week_type' => 'always',
                'number' => 4
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Tue',
                'week_type' => 'always',
                'number' => 5
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 1,
                'auditorium_id' => 3,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Wed',
                'week_type' => 'down',
                'number' => 1
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Wed',
                'week_type' => 'down',
                'number' => 3
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Thu',
                'week_type' => 'up',
                'number' => 4
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Thu',
                'week_type' => 'down',
                'number' => 4
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Thu',
                'week_type' => 'always',
                'number' => 5
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 3,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Fri',
                'week_type' => 'up',
                'number' => 1
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 5,
                'lesson_type_id' => 1,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Fri',
                'week_type' => 'always',
                'number' => 2
            ],
            [
                'subject_id' => 1,
                'employment_type_id' => 1,
                'auditorium_id' => 4,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-07',
                'week_day' => 'Fri',
                'week_type' => 'always',
                'number' => 4
            ],
        ];
*/

        $data = [
            [
                'subject_id' => 2,
                'employment_type_id' => 2,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-04',
                'week_day' => 'Mon',
                'week_type' => 'always',
                'number' => 1
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 2,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-04',
                'week_day' => 'Mon',
                'week_type' => 'always',
                'number' => 2
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 2,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-04',
                'week_day' => 'Wed',
                'week_type' => 'always',
                'number' => 4
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 2,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-04',
                'week_day' => 'Thu',
                'week_type' => 'always',
                'number' => 2
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 2,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-04',
                'week_day' => 'Thu',
                'week_type' => 'always',
                'number' => 4
            ],
            [
                'subject_id' => 2,
                'employment_type_id' => 2,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-04',
                'week_day' => 'Fri',
                'week_type' => 'always',
                'number' => 2
            ],


            [
                'subject_id' => 2,
                'employment_type_id' => 2,
                'auditorium_id' => 1,
                'lesson_type_id' => 2,
                'start_date' => '2021-02-08',
                'end_date' => '2021-06-04',
                'week_day' => 'Mon',
                'week_type' => 'always',
                'number' => 1
            ],
        ];

        DB::table('lessons')->insert($data);
    }
}
