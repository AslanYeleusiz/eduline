<?php

namespace Database\Seeders;

use App\Models\NewsComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            RolesSeeder::class,
            UsersSeeder::class,
            MaterialClassesSeeder::class,
            MaterialDirectionsSeeder::class,
            MaterialSubjectsSeeder::class,
            MaterialsSeeder::class,
            MaterialCommentsSeeder::class,
            NewsTypesSeeder::class,
            NewsSeeder::class,
            NewsCommentsSeeder::class,
            SendingMaterialJournalSeeder::class,
            SubscriptionsSeeder::class,
            PersonalAdviceSeeder::class,
            TestLanguagesSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
