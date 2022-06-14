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
        Schema::create('full_test_user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('full_tests')->cascadeOnDelete();
// 
            // $table->string('test_uuid');
            $table->foreignId('subject_id')->constrained('test_subjects')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('test_questions')->cascadeOnDelete();
            $table->string('answer')->nullable();
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
        Schema::dropIfExists('full_test_user_answers');
    }
};
