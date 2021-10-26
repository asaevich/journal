<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturerLessonTable extends Migration
{
    public function up()
    {
        Schema::create('lecturer_lesson', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->constrained('lecturers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['lecturer_id', 'lesson_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecturer_lesson');
    }
}
