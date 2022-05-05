<?php

namespace Database\Seeders;

use App\Models\NewsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'ru' => 'Бизнес',
                'kk' => 'Бизнес'
            ],
            [
                'ru' => 'Политические',
                'kk' => 'Саяси'
            ],
            [
                'ru' => 'Криминальные',
                'kk' => 'Криминальные'
            ],
            [
                'ru' => 'Культурные',
                'kk' => 'Мәдени'
            ],
            [
                'ru' => 'Спортивные',
                'kk' => 'Спорттық'
            ],
            [
                'ru' => 'Музыкальные',
                'kk' => 'Музыкалық'
            ],
            [
                'ru' => 'Социальные',
                'kk' => 'Әлеуметтік'
            ],
        ];
        foreach ($types as $type) {
            NewsType::create([
                'name' => $type,
                'is_main' => rand(0, 1)
            ]);
        }
    }
}
