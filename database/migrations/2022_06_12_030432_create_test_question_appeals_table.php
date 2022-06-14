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
        Schema::create('test_question_appeals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('test_questions')->cascadeOnDelete();
            $table->foreignId('test_id')->constrained('full_tests')->cascadeOnDelete();
            $table->tinyInteger('type')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('test_question_appeals');
    }
};
