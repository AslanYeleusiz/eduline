<?php

namespace Database\Seeders;

use App\Models\TestLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestLanguagesSeeder extends Seeder
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
                'name' => 'Қазақша',
                'code' => 'kk',
            ],
            [
                'name' => 'Русский язык',
                'code' => 'kk',
            ]
        ];
        foreach ($data as $datum) {
            TestLanguage::create($datum);
        }
    }
}
