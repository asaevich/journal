<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultiesTable extends Migration
{
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->text('name')->unique();
            $table->text('abbreviation')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faculties');
    }
}
