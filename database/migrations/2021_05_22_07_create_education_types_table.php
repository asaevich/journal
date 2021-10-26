<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTypesTable extends Migration
{
    public function up()
    {
        Schema::create('education_types', function (Blueprint $table) {
            $table->id();
            $table->text('type')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('education_types');
    }
}
