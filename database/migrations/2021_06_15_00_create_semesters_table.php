<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestersTable extends Migration
{
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number');
            $table->year('start_education_year');
            $table->date('start_date')->unique();
            $table->date('end_date')->unique();
            $table->unique(['number', 'start_education_year', 'start_date', 'end_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('semesters');
    }
}
