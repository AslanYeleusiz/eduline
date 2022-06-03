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
        Schema::table('test_subject_option_questions', function (Blueprint $table) {
            $table->foreignId('option_id')->constrained('test_subject_options')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('test_questions')->cascadeOnDelete();
            $table->integer('number')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_subject_option_questions', function (Blueprint $table) {
            //
        });
    }
};
