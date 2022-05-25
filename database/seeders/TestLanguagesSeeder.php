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
            'Қазақша',
            'Русский язык'
        ];
        foreach($data as $datum) {
            TestLanguage::create(['name' => $datum]);
        }
    }
}
