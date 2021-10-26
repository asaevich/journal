<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriumsTable extends Migration
{
    public function up()
    {
        Schema::create('auditoriums', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('building_number');
            $table->unsignedTinyInteger('auditorium_number');
            $table->unique(['building_number', 'auditorium_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('auditoriums');
    }
}
