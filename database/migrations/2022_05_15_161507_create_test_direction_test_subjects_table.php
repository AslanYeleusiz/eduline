<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_direction_test_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direction_id')->constrained('test_directions')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('test_subjects')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_direction_test_subjects');
    }
};
