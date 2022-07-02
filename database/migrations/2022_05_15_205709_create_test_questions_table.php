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
        Schema::create('test_questions', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
                // $table->id();
            // $table->foreignId('subject_id')->constrained('ubt_subjects');
            $table->text('text');
            // TODO:: {number, text, is_correct}s
            $table->json('answers');
            $table->foreignId('subject_id')->constrained('test_subjects')->cascadeOnDelete();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('test_questions');
    }
};
