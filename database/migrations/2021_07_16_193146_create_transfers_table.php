<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('old_date');
            $table->date('new_date');
            $table->unique(['lesson_id', 'old_date', 'new_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
