<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    //$router->get('/', 'HomeController@index')->name('home');

    $router->resource('auditoriums', AuditoriumController::class);
    $router->resource('departments', DepartmentController::class);
    $router->resource('education-types', EducationTypeController::class);
    $router->resource('employment-types', EmploymentTypeController::class);
    $router->resource('faculties', FacultyController::class);
    $router->resource('groups', GroupController::class);
    $router->resource('holidays', HolidayController::class);
    $router->resource('lecturers', LecturerController::class);
    $router->resource('lecturer-positions', LecturerPositionController::class);
    $router->resource('lessons', LessonController::class);
    $router->resource('lesson-types', LessonTypeController::class);
    $router->resource('semesters', SemesterController::class);
    $router->resource('specialties', SpecialtyController::class);
    $router->resource('subjects', SubjectController::class);

});
