<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Patricia Vance',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password')
        ]);

        $admin = User::create([
            'name' => 'Muhammad Umar',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $user = User::create([
            'name' => 'Usman',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);


        $supportAgent = User::create([
            'name' => 'Agent',
            'email' => 'agent@gmail.com',
            'password' => bcrypt('password'),
        ]);


        $superAdmin->assignRole(User::SUPER_ADMIN_ROLE);
        $admin->assignRole(User::ADMIN_ROLE);
        $user->assignRole(User::USER_ROLE);
        $supportAgent->assignRole(User::SUPPORT_AGENT_ROLE);

        //  User::factory()->count(10)->create();
    }
}
