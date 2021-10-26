<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialty_id')->constrained('specialties')->restrictOnDelete()->cascadeOnUpdate();
            $table->text('subgroup')->nullable();
            $table->foreignId('education_type_id')->constrained('education_types')->restrictOnDelete()->cascadeOnUpdate();
            $table->year('admission_year');
            $table->unique(['specialty_id', 'subgroup', 'education_type_id', 'admission_year']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
