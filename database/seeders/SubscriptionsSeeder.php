<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionsSeeder extends Seeder
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
                'name' => '1 айға жазылу',
                'duration' => 1,
                'price' => 2590,
            ],
            [
                'name' => '3 айға жазылу',
                'duration' => 3,
                'price' => 1990,
            ],
            [
                'name' => '6 айға жазылу
                ',
                'duration' => 6,
                'price' => 1490,
            ],
            [
                'name' => '12 айға жазылу',
                'duration' => 12,
                'price' => 990,
            ],
        ];
        foreach($data as $datum) {
            Subscription::create($datum);
        }
    }
}