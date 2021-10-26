<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTypesTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_types', function (Blueprint $table) {
            $table->id();
            $table->text('type')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_types');
    }
}
