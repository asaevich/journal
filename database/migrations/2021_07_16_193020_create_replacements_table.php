<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplacementsTable extends Migration
{
    public function up()
    {
        Schema::create('replacements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('lesson_date');
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('old_lecturer_id')->constrained('lecturers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('new_lecturer_id')->constrained('lecturers')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('replacements');
    }
}
