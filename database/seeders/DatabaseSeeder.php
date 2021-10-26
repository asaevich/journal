<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        HolidaysSeeder::run();
        SemesterSeeder::run();
        FacultiesSeeder::run();
        DepartmentsSeeder::run();
        SubjectsSeeder::run();
        SpecialtiesSeeder::run();
        LecturerPositionsSeeder::run();
        EducationTypesSeeder::run();
        EmploymentTypesSeeder::run();
        AuditoriumsSeeder::run();
        LessonTypesSeeder::run();
        LecturersSeeder::run();
        GroupsSeeder::run();
        LessonsSeeder::run();
        LecturerLessonSeeder::run();
        GroupLessonSeeder::run();
        TransfersSeeder::run();
        ReplacementsSeeder::run();
    }
}
