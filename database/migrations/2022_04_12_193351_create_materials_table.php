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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('material_subjects')->cascadeOnDelete();
            $table->foreignId('direction_id')->constrained('material_directions')->cascadeOnDelete();
            $table->string('class_id')->constrained('material_classes')->cascadeOnDelete();
            $table->string('file_name')->nullable();
            $table->integer('view')->default(0);
            $table->integer('download')->default(0);
            $table->integer('is_active')->default(1);
            $table->text('comment_when_deleted')->nullable();
            $table->text('comment_refusal_delete')->nullable();
            $table->tinyInteger('status_deleted')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('materials');
    }
};
