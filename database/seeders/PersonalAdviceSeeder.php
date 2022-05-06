<?php

namespace Database\Seeders;

use App\Models\PersonalAdvice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalAdviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => [
                    'ru' => 'Учимся создавать авторскую программу',
                    'kk' => 'Авторлық бағдарлама жасауды үйрену'
                ],
                'price' => 8000
            ],
            [
                'title' => [
                    'ru' => 'Педагогическое айкидо',
                    'kk' => 'Педагогикалық айкидо'
                ],
                'price' => 10000
            ]
        ];
        foreach($data as $datum) {
            PersonalAdvice::create($datum);
        }
    }
}
