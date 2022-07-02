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
        Schema::create('full_test_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('full_tests')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('test_subjects')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('full_test_subjects');
    }
};
