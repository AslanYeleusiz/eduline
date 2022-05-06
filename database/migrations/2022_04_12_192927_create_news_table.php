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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('short_description');
            $table->longText('description');
            $table->text('image')->default(json_encode(['kk' => '', 'ru' => '']));
            $table->integer('view')->default('0');
            //admin added user
            $table->foreignId('user_id')->nullable()->cascadeOnDelete();
            $table->foreignId('news_types_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('news');
    }
};
