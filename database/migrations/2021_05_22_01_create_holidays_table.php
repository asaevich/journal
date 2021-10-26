<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidaysTable extends Migration
{
    public function up()
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->text('holiday');
            $table->date('start_date');
            $table->date('end_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('holidays');
    }
}
