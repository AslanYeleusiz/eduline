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
        Schema::create('test_trainers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_subject_id')->constrained()->cascadeOnDelete();
            $table->integer('price')->default(0);
            $table->text('description');
            $table->integer('installments');
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('test_trainers');
    }
};
