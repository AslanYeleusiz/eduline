<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
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
                'name' => 'админ',
                'is_general' => false 
            ],
            [
                'name' => 'Мұғалім',
                'is_general' => true 
            ],
            [
                'name' => 'Оқушы',
                'is_general' => true 
            ],
            [
                'name' => 'Тәрбиеші',
                'is_general' => true 
            ],
            [
                'name' => 'Студент',
                'is_general' => true 
            ],
        ];
        foreach($data as $datum){
            Role::create($datum);
        }
    }
}
