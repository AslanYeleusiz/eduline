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
        Schema::create('salary_calculators', function (Blueprint $table) {
            $table->id();
            //Месячный расчетный показатель
            $table->double('mrp');
            //Базовый должностной оклад
            $table->double('bdo');
            //Партийный взнос
            $table->double('pv');
            // Стандартты налоговый вычет
            $table->double('snv');
            // Доплата по обновленной программе
            $table->double('dpop');
            // // За час БДО bdo / 16
            // $table->double('zchbdo');
            // Коэфицент
            // $table->double('kf');
            // // Должностной оклад bdo * kf
            // $table->double('do');
            // month ?
            // $table->tinyInteger('month');
            // $table->integer('year');
            $table->integer('year');
            $table->integer('month');
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
        Schema::dropIfExists('salary_calculators');
    }
};
