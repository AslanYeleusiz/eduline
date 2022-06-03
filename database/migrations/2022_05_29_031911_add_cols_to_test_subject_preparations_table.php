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
        Schema::table('test_subject_preparations', function (Blueprint $table) {
            $table->foreignId('subject_id')->constrained('test_subjects')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('video_link')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('test_subject_preparations')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_subject_preparations', function (Blueprint $table) {
            //
        });
    }
};
