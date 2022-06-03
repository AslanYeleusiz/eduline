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
        Schema::table('test_subject_preparation_classes', function (Blueprint $table) {
            $table->foreignId('subject_id')->constrained('test_subjects')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('test_classes')->cascadeOnDelete();
            $table->foreignId('preparation_id')->constrained('test_subject_preparations')->cascadeOnDelete();
            // $table->integer('number')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_subject_preparation_classes', function (Blueprint $table) {
            //
        });
    }
};
