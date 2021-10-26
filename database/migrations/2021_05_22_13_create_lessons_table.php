<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('employment_type_id')->constrained('employment_types')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('auditorium_id')->constrained('auditoriums')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('lesson_type_id')->constrained('lesson_types')->restrictOnDelete()->cascadeOnUpdate();
            $table->date('start_date')->index();
            $table->date('end_date')->index();
            $table->text('week_day');
            $table->text('week_type');
            $table->unsignedTinyInteger('number');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
