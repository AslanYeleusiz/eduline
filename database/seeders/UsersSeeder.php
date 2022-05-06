<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $adminUsers = [
            [
                'full_name' => 'Maksat Daulet',
                'phone' => '+7 707 777 66 77',
                'email' => 'admin@mail.ru',
                'role_id' => Role::ADMIN_ROLE,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ],
            [
                'full_name' => 'Maksat Daulet',
                'phone' => '+7 707 777 66 77',
                'email' => 'admin@mail.ru2',
                'role_id' => Role::ADMIN_ROLE,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        ];
        
        foreach($adminUsers as $adminUser) {
            User::create($adminUser);
        }
    }
}
