<?php

namespace Database\Seeders;

use App\Models\TestDirection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDirectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Мектепке дейінгі білім беру',
            'Қосымша білім беру',
            'Жалпы орта білім беру',
            'Студенттер'
        ];
        foreach($data as $datum) {
            TestDirection::create(['name' => $datum]);
        }
    }
}
