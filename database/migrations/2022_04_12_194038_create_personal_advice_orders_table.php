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
        Schema::create('personal_advice_orders', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('full_name');
            $table->foreignId('personal_advice_id')->constrained('personal_advice')->cascadeOnDelete();
            $table->text('comment_for_note')->nullable();
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
        Schema::dropIfExists('personal_advice_orders');
    }
};
