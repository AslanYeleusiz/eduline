<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SendingMaterialJournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = Material::inRandomOrder()->limit(10)->get();
        $users = User::inRandomOrder()->limit(10)->get();
        foreach($materials as $material) {
            $material->journals()->createMany([
                [
                    'user_id' => $users->random()->first()->id
                ],
                [
                    'user_id' => $users->random()->first()->id
                ],
                [
                    'user_id' => $users->random()->first()->id
                ],
            ]);
        }
    }
}
