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
        Schema::table('salary_calculator_histories', function (Blueprint $table) {
            $table->integer('working_with_children_with_special_educational_needs')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salary_calculator_histories', function (Blueprint $table) {
            $table->dropColumn('working_with_children_with_special_educational_needs');
        });
    }
};
