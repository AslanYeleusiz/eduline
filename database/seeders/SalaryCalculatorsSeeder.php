<?php

namespace Database\Seeders;

use App\Models\SalaryCalculator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryCalculatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salaryCalculator = new SalaryCalculator();
        $salaryCalculator->mrp = 3180;
        $salaryCalculator->bdo =  17697;
        $salaryCalculator->pv = 297.50;
        $salaryCalculator->snv = 44550;
        $salaryCalculator->dpop = 54816;
        $salaryCalculator->year = 2022;
        $salaryCalculator->month = 2;
        $salaryCalculator->save();
    }
}
