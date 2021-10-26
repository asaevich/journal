<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLessonTable extends Migration
{
    public function up()
    {
        Schema::create('group_lesson', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['group_id', 'lesson_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_lesson');
    }
}
