<?php

namespace Database\Seeders;

use App\Models\SalaryCalculatorCoefficient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryCalculatorCoefficientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'B2' => [
                0 => [
                    'category' => 1,
                    'experiences' => [
                        [
                            'from' => 0,
                            'to' => 1,
                            'coefficient' => 4.67
                        ],
                        [
                            'from' => 1,
                            'to' => 2,
                            'coefficient' => 4.74
                        ],
                        [
                            'from' => 2,
                            'to' => 3,
                            'coefficient' => 4.81
                        ],
                        [
                            'from' => 3,
                            'to' => 5,
                            'coefficient' => 4.88
                        ],
                        [
                            'from' => 5,
                            'to' => 7,
                            'coefficient' => 4.95
                        ],
                        [
                            'from' => 7,
                            'to' => 10,
                            'coefficient' => 5.01
                        ],
                        [
                            'from' => 10,
                            'to' => 13,
                            'coefficient' => 5.08
                        ],
                        [
                            'from' => 13,
                            'to' => 16,
                            'coefficient' => 5.16
                        ],
                        [
                            'from' => 16,
                            'to' => 20,
                            'coefficient' => 5.24
                        ],
                        [
                            'from' => 20,
                            'to' => 25,
                            'coefficient' => 5.32
                        ],
                        [
                            'from' => 25,
                            'to' => 100,
                            'coefficient' => 5.41
                        ],
                    ]
                ],
                1 => [
                    'category' => 2,
                    'experiences'    => [
                        [
                            'from' => 0,
                            'to' => 1,
                            'coefficient' => 4.39
                        ],
                        [
                            'from' => 1,
                            'to' => 2,
                            'coefficient' => 4.50
                        ],
                        [
                            'from' => 2,
                            'to' => 3,
                            'coefficient' => 4.57
                        ],
                        [
                            'from' => 3,
                            'to' => 5,
                            'coefficient' => 4.65
                        ],
                        [
                            'from' => 5,
                            'to' => 7,
                            'coefficient' => 4.72
                        ],
                        [
                            'from' => 7,
                            'to' => 10,
                            'coefficient' => 4.79
                        ],
                        [
                            'from' => 10,
                            'to' => 13,
                            'coefficient' => 4.86
                        ],
                        [
                            'from' => 13,
                            'to' => 16,
                            'coefficient' => 4.95
                        ],
                        [
                            'from' => 16,
                            'to' => 20,
                            'coefficient' => 5.03
                        ],
                        [
                            'from' => 20,
                            'to' => 25,
                            'coefficient' => 5.12
                        ],
                        [
                            'from' => 25,
                            'to' => 100,
                            'coefficient' => 5.20
                        ],
                    ]
                ],
                2 => [
                    'category' => 3,
                    'experiences'    => [
                        [
                            'from' => 0,
                            'to' => 1,
                            'coefficient' => 4.36
                        ],
                        [
                            'from' => 1,
                            'to' => 2,
                            'coefficient' => 4.44
                        ],
                        [
                            'from' => 2,
                            'to' => 3,
                            'coefficient' => 4.51
                        ],
                        [
                            'from' => 3,
                            'to' => 5,
                            'coefficient' => 4.59
                        ],
                        [
                            'from' => 5,
                            'to' => 7,
                            'coefficient' => 4.66
                        ],
                        [
                            'from' => 7,
                            'to' => 10,
                            'coefficient' => 4.74
                        ],
                        [
                            'from' => 10,
                            'to' => 13,
                            'coefficient' => 4.81
                        ],
                        [
                            'from' => 13,
                            'to' => 16,
                            'coefficient' => 4.90
                        ],
                        [
                            'from' => 16,
                            'to' => 20,
                            'coefficient' => 4.99
                        ],
                        [
                            'from' => 20,
                            'to' => 25,
                            'coefficient' => 5.08
                        ],
                        [
                            'from' => 25,
                            'to' => 100,
                            'coefficient' => 5.16
                        ],
                    ]
                ],
                3 => [
                    'category' => 4,
                    'experiences'    => [
                        [
                            'from' => 0,
                            'to' => 1,
                            'coefficient' => 4.10
                        ],
                        [
                            'from' => 1,
                            'to' => 2,
                            'coefficient' => 4.14
                        ],
                        [
                            'from' => 2,
                            'to' => 3,
                            'coefficient' => 4.19
                        ],
                        [
                            'from' => 3,
                            'to' => 5,
                            'coefficient' => 4.23
                        ],
                        [
                            'from' => 5,
                            'to' => 7,
                            'coefficient' => 4.27
                        ],
                        [
                            'from' => 7,
                            'to' => 10,
                            'coefficient' => 4.33
                        ],
                        [
                            'from' => 10,
                            'to' => 13,
                            'coefficient' => 4.38
                        ],
                        [
                            'from' => 13,
                            'to' => 16,
                            'coefficient' => 4.49
                        ],
                        [
                            'from' => 16,
                            'to' => 20,
                            'coefficient' => 4.59
                        ],
                        [
                            'from' => 20,
                            'to' => 25,
                            'coefficient' => 4.67
                        ],
                        [
                            'from' => 25,
                            'to' => 100,
                            'coefficient' => 4.73
                        ],
                    ]
                ],
            ],
            'B4' => [
                0 => [
                    'category' => 1,
                    'experiences' => [
                        [
                            'from' => 0,
                            'to' => 1,
                            'coefficient' => 3.95
                        ],
                        [
                            'from' => 1,
                            'to' => 2,
                            'coefficient' => 3.99
                        ],
                        [
                            'from' => 2,
                            'to' => 3,
                            'coefficient' => 4.05
                        ],
                        [
                            'from' => 3,
                            'to' => 5,
                            'coefficient' => 4.11
                        ],
                        [
                            'from' => 5,
                            'to' => 7,
                            'coefficient' => 4.16
                        ],
                        [
                            'from' => 7,
                            'to' => 10,
                            'coefficient' => 4.22
                        ],
                        [
                            'from' => 10,
                            'to' => 13,
                            'coefficient' => 4.28
                        ],
                        [
                            'from' => 13,
                            'to' => 16,
                            'coefficient' => 4.34
                        ],
                        [
                            'from' => 16,
                            'to' => 20,
                            'coefficient' => 4.40
                        ],
                        [
                            'from' => 20,
                            'to' => 25,
                            'coefficient' => 4.45
                        ],
                        [
                            'from' => 25,
                            'to' => 100,
                            'coefficient' => 4.52
                        ],
                    ]
                ],
                1 => [
                    'category' => 2,
                    'experiences'    => [
                        [
                            'from' => 0,
                            'to' => 1,
                            'coefficient' => 3.73
                        ],
                        [
                            'from' => 1,
                            'to' => 2,
                            'coefficient' => 3.79
                        ],
                        [
                            'from' => 2,
                            'to' => 3,
                            'coefficient' => 3.85
                        ],
                        [
                            'from' => 3,
                            'to' => 5,
                            'coefficient' => 3.92
                        ],
                        [
                            'from' => 5,
                            'to' => 7,
                            'coefficient' => 3.97
                        ],
                        [
                            'from' => 7,
                            'to' => 10,
                            'coefficient' => 4.04
                        ],
                        [
                            'from' => 10,
                            'to' => 13,
                            'coefficient' => 4.10
                        ],
                        [
                            'from' => 13,
                            'to' => 16,
                            'coefficient' => 4.17
                        ],
                        [
                            'from' => 16,
                            'to' => 20,
                            'coefficient' => 4.25
                        ],
                        [
                            'from' => 20,
                            'to' => 25,
                            'coefficient' => 4.32
                        ],
                        [
                            'from' => 25,
                            'to' => 100,
                            'coefficient' => 4.39
                        ],
                    ]
                ],
                2 => [
                    'category' => 3,
                    'experiences'    => [
                        [
                            'from' => 0,
                            'to' => 1,
                            'coefficient' => 3.67
                        ],
                        [
                            'from' => 1,
                            'to' => 2,
                            'coefficient' => 3.73
                        ],
                        [
                            'from' => 2,
                            'to' => 3,
                            'coefficient' => 3.79
                        ],
                        [
                            'from' => 3,
                            'to' => 5,
                            'coefficient' => 3.85
                        ],
                        [
                            'from' => 5,
                            'to' => 7,
                            'coefficient' => 3.91
                        ],
                        [
                            'from' => 7,
                            'to' => 10,
                            'coefficient' => 3.97
                        ],
                        [
                            'from' => 10,
                            'to' => 13,
                            'coefficient' => 4.03
                        ],
                        [
                            'from' => 13,
                            'to' => 16,
                            'coefficient' => 4.09
                        ],
                        [
                            'from' => 16,
                            'to' => 20,
                            'coefficient' => 4.16
                        ],
                        [
                            'from' => 20,
                            'to' => 25,
                            'coefficient' => 4.22
                        ],
                        [
                            'from' => 25,
                            'to' => 100,
                            'coefficient' => 4.29
                        ],
                    ]
                ],
                3 => [
                    'category' => 4,
                    'experiences'    => [
                        [
                            'from' => 0,
                            'to' => 1,
                            'coefficient' => 3.32
                        ],
                        [
                            'from' => 1,
                            'to' => 2,
                            'coefficient' => 3.36
                        ],
                        [
                            'from' => 2,
                            'to' => 3,
                            'coefficient' => 3.41
                        ],
                        [
                            'from' => 3,
                            'to' => 5,
                            'coefficient' => 3.45
                        ],
                        [
                            'from' => 5,
                            'to' => 7,
                            'coefficient' => 3.49
                        ],
                        [
                            'from' => 7,
                            'to' => 10,
                            'coefficient' => 3.53
                        ],
                        [
                            'from' => 10,
                            'to' => 13,
                            'coefficient' => 3.57
                        ],
                        [
                            'from' => 13,
                            'to' => 16,
                            'coefficient' => 3.61
                        ],
                        [
                            'from' => 16,
                            'to' => 20,
                            'coefficient' => 3.65
                        ],
                        [
                            'from' => 20,
                            'to' => 25,
                            'coefficient' => 3.69
                        ],
                        [
                            'from' => 25,
                            'to' => 100,
                            'coefficient' => 3.73
                        ],
                    ]
                ],
            ],
        ];
        foreach($data as $education => $educationValue) {
            foreach($educationValue as $educationCategory){
                foreach ($educationCategory['experiences'] as $categoryExperience) {
                    $salaryCoefficient = new SalaryCalculatorCoefficient();
                    $salaryCoefficient->category = $educationCategory['category'];
                    $salaryCoefficient->year = 2016;
                    $salaryCoefficient->month = 1;
                    $salaryCoefficient->education = $education;
                    $salaryCoefficient->category = $educationCategory['category'];
                    $salaryCoefficient->experience_from = $categoryExperience['from'];
                    $salaryCoefficient->experience_to = $categoryExperience['to'];
                    $salaryCoefficient->coefficient = $categoryExperience['coefficient'];
                    $salaryCoefficient->save();
                }
            }
        }
    }
}
