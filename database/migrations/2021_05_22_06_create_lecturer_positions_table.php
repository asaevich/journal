<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturerPositionsTable extends Migration
{
    public function up()
    {
        Schema::create('lecturer_positions', function (Blueprint $table) {
            $table->id();
            $table->text('position')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecturer_positions');
    }
}
