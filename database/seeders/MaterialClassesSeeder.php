<?php

namespace Database\Seeders;

use App\Models\MaterialClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialClassesSeeder extends Seeder
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
                'name' => 'Барлық сыныптар',
            ],
            [
                'name' => 'Мектепке дейінгі балалар',
            ],
            [
                'name' => '1 сынып',
            ],
            [
                'name' => '2 сынып',
            ],
            [
                'name' => '3 сынып',
            ],
            [
                'name' => '4 сынып',
            ],
            [
                'name' => '5 сынып',
            ],
            [
                'name' => '6 сынып',
            ],
            [
                'name' => '7 сынып',
            ],
            [
                'name' => '8 сынып',
            ],
            [
                'name' => '9 сынып',
            ],
            [
                'name' => '10 сынып',
            ],
            [
                'name' => '11 сынып',
            ],
            [
                'name' => '12 сынып',
            ],
            [
                'name' => 'Басқа',
            ],
        ];
        foreach($data as $datum) {
            MaterialClass::create($datum);
        } 
    }
}
