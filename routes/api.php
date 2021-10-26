<?php

use App\Http\Controllers\AuditoriumController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EducationTypeController;
use App\Http\Controllers\EmploymentTypeController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LecturerPositionController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonTypeController;
use App\Http\Controllers\ReplacementController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('refresh', [AuthController::class, 'refresh']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::apiResource('auditoriums', AuditoriumController::class)->only(['index']);
    Route::apiResource('departments', DepartmentController::class)->only(['index']);
    Route::apiResource('education-types', EducationTypeController::class)->only(['index']);
    Route::apiResource('employment-types', EmploymentTypeController::class)->only(['index']);
    Route::apiResource('faculties', FacultyController::class)->only(['index']);
    Route::apiResource('groups', GroupController::class)->only(['index']);
    Route::apiResource('holidays', HolidayController::class)->only(['index']);
    Route::apiResource('lecturers', LecturerController::class)->only(['index']);
    Route::apiResource('lecturer-positions', LecturerPositionController::class)->only(['index']);
    Route::apiResource('lessons', LessonController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::apiResource('lesson-types', LessonTypeController::class)->only(['index']);
    Route::apiResource('replacements', ReplacementController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::apiResource('semesters', SemesterController::class)->only(['index']);
    Route::apiResource('specialties', SpecialtyController::class)->only(['index']);
    Route::apiResource('subjects', SubjectController::class)->only(['index']);

    Route::get('journal', [JournalController::class, 'journal']);

    Route::apiResource('lessons.transfers', TransferController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::apiResource('lecturers.lessons', LessonController::class)->only(['index']);

    Route::apiResource('faculties.departments', DepartmentController::class)->only(['index']);
    Route::apiResource('faculties.groups', GroupController::class)->only(['index']);
    Route::apiResource('faculties.lecturers', LecturerController::class)->only(['index']);
    Route::apiResource('faculties.specialties', SpecialtyController::class)->only(['index']);
    Route::apiResource('faculties.subjects', SubjectController::class)->only(['index']);

    Route::apiResource('faculties.departments.groups', GroupController::class)->only(['index']);
    Route::apiResource('faculties.departments.lecturers', LecturerController::class)->only(['index']);
    Route::apiResource('faculties.departments.specialties', SpecialtyController::class)->only(['index']);
    Route::apiResource('faculties.departments.subjects', SubjectController::class)->only(['index']);

    Route::post('logout', [AuthController::class, 'logout']);
});
