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
        Schema::create('test_subject_option_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('time')->default(3600);
            $table->boolean('is_started')->default(0);
            $table->boolean('is_finished')->default(0);
            $table->integer('score')->default(0);
            $table->integer('correct_answers_count')->default(0);
            $table->integer('incorrect_answers_count')->default(0);
            $table->foreignId('subject_id')->constrained('test_subjects')->cascadeOnDelete();
            $table->foreignId('option_id')->constrained('test_subject_options')->cascadeOnDelete();
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
        Schema::dropIfExists('test_subject_option_tests');
    }
};
