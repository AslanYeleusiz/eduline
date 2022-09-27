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
        Schema::create('salary_calculator_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->string('education')->default('B2');

            $table->integer('experience_year')->default(0);
            $table->integer('experience_month')->default(0);
            $table->integer('experience_day')->default(0);
            $table->boolean('work_in_village')->default(false);
            $table->boolean('special_working_conditions')->default(false);
            $table->tinyInteger('work_in_env_disaster_zone')->default(1);
            $table->tinyInteger('work_in_radiation_risk_zone')->default(1);
            $table->tinyInteger('teaching_in_english')->default(1);
            $table->boolean('magister_degree')->default(false);
            $table->boolean('mentoring')->default(false);
            $table->tinyInteger('ped_skill')->default(1);
            $table->boolean('class_guide')->default(false);
            $table->boolean('class_guide_elementary_grade')->default(false);
            $table->integer('class_occupancy')->default(0);
            $table->tinyInteger('for_managing_office')->default(1);
            $table->boolean('for_running_workshop')->default(false);
            $table->tinyInteger('for_checking_notebook')->default(1);
            $table->integer('for_checking_notebooks_full_classes')->default(0);
            // classes_less_than_15_students
            $table->integer('for_checking_notebooks_half_classes')->default(0);
            $table->integer('training_load_billing_load')->default(0);
            $table->integer('homeschooling')->default(0);
            $table->integer('hours_with_lyceum_classes')->default(0);
            $table->integer('hours_in_depth_study')->default(0);
            $table->integer('hours_updated_content')->default(0);
            $table->integer('hours_specialized_subjects')->default(0);
            $table->integer('replace_hours_half_classes')->default(0);
            $table->integer('replace_hour_full_classes')->default(0);
            $table->integer('replace_hours_new_program_half_classes')->default(0);
            $table->integer('replace_hours_new_program_full_classes')->default(0);
            $table->integer('replace_hours_lyceum_classes_half_classes')->default(0);
            $table->integer('replace_hours_lyceum_classes_full_classes')->default(0);
            $table->integer('replace_classroom_management_elementary_grade_half_classes')->default(0);
            $table->integer('replace_classroom_management_elementary_grade_full_classes')->default(0);
            $table->integer('replace_classroom_management_senior_grade_half_classes')->default(0);
            $table->integer('replace_classroom_management_senior_grade_full_classes')->default(0);
            $table->boolean('app_withholding_union_dues')->default(false);
            $table->boolean('app_withholding_party_contributions')->default(false);
            $table->boolean('working_pensioner')->default(false);
            $table->boolean('exempt_from_paying_individual_income_tax')->default(false);
            $table->tinyInteger('category')->default(4);
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_calculator_histories');
    }
};
