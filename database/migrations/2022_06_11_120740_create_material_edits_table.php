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
        Schema::create('material_edits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('material_id')->constrained('materials')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->foreignId('subject_id')->constrained('material_subjects')->cascadeOnDelete();
            $table->foreignId('direction_id')->constrained('material_directions')->cascadeOnDelete();
            $table->string('class_id')->constrained('material_classes')->cascadeOnDelete();
            $table->tinyInteger('status_deleted')->nullable();
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
        Schema::dropIfExists('material_edits');
    }
};
