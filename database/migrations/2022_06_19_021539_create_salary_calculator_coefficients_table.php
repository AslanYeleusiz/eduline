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
        Schema::create('salary_calculator_coefficients', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->tinyInteger('month');
            // B2, B4
            $table->string('education');
            //
            $table->integer('category');
            $table->string('category_name')->nullable();
            $table->integer('experience_from');
            $table->integer('experience_to');
            $table->double('coefficient')->default(0);
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
        Schema::dropIfExists('salary_calculator_coefficients');
    }
};
