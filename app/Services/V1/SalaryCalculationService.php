<?php


namespace App\Services\V1;

use App\Models\SalaryCalculatorCoefficient;
use Illuminate\Support\Str;

class SalaryCalculationService
{
    public static function getCoefficent($education, $category, $experience, $year, $month)
    {
        $education = Str::upper($education);
        $edications = ['B2', 'B4'];
        $coefficient = 0;
        if (!in_array($education, $edications)) {
            return $coefficient;
        }
        $salaryExperience = SalaryCalculatorCoefficient::where('education', $education)
        ->where('category', $category)
        ->where('experience_from', '<=', $experience)
        ->where('experience_to', '>', $experience)
        ->when($year && $month, function($query) use ($year, $month) {
            return $query->where(function($query) use ($year, $month) {
                return $query->where('year', $year)->where('month', $month);
            })->orWhere(function($query) use ($year, $month) {
                return $query->where('year', $year);
            })->orWhere(function($query) {
                return $query->whereNotNull('year');
            });
        })
        ->orderBy('year', 'desc')->orderBy('month', 'desc')
        ->first();
        // dd($salaryExperience);
        if(!empty($salaryExperience)) {
            return $salaryExperience->coefficient;
        }
        return $coefficient;
        // $categoriesWithCoefficents = self::getListCategoryWithCoefficents();
        // foreach ($categoriesWithCoefficents[$education] as $categoriesWithCoefficent) {
        //     if ($categoriesWithCoefficent['degree'] == $category) {
        //         foreach ($categoriesWithCoefficent['experiences'] as $categoriesWithCoefficientExperience) {
        //             if ($categoriesWithCoefficientExperience['from'] < $experince && $experince <= $categoriesWithCoefficientExperience['to']) {
        //                 $coefficient = $categoriesWithCoefficientExperience['coefficient'];
        //             }
        //         }
        //     }
        // }
        return $coefficient;
    }
    public static function getListCategoryWithCoefficents()
    {
        return  [
            'B2' => [
                0 => [
                    'degree' => 1,
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
                    'degree' => 2,
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
                    'degree' => 3,
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
                    'degree' => 4,
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
                    'degree' => 1,
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
                    'degree' => 2,
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
                    'degree' => 3,
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
                    'degree' => 4,
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
    }
}
