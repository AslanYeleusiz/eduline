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
        Schema::create('order_update_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('subject_id')->constrained('material_subjects')->cascadeOnDelete();
            $table->foreignId('direction_id')->constrained('material_directions')->cascadeOnDelete();
            $table->string('class_id')->constrained('material_classes')->cascadeOnDelete();
            $table->string('material_id')->constrained('materials')->cascadeOnDelete();
            // rejected = 1, accept = 2 
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('order_update_materials');
    }
};
