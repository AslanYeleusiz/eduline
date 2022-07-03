<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryCalculatorHistory extends Model
{
    use HasFactory;

    protected $casts = [
        'work_in_village' => 'boolean',
        'special_working_conditions' => 'boolean',
        'magister_degree' => 'boolean',
        'mentoring' => 'boolean',
        'class_guide' => 'boolean',
        'class_guide_elementary_grade' => 'boolean',
        'for_running_workshop' => 'boolean',
        'app_withholding_union_dues' => 'boolean',
        'app_withholding_party_contributions' => 'boolean',
        'working_pensioner' => 'boolean',
        'exempt_from_paying_individual_income_tax' => 'boolean',
        'created_at' => 'datetime:H:i,d-m-Y',
    ];
}
