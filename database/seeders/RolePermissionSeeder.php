<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User permissions

        Permission::firstOrCreate(['name' => 'user.create']);
        Permission::firstOrCreate(['name' => 'user.view']);
        Permission::firstOrCreate(['name' => 'user.update']);
        Permission::firstOrCreate(['name' => 'user.delete']);

        // Category permissions

        Permission::firstOrCreate(['name' => 'category.create']);
        Permission::firstOrCreate(['name' => 'category.view']);
        Permission::firstOrCreate(['name' => 'category.update']);
        Permission::firstOrCreate(['name' => 'category.delete']);

        // Ticket permissions

        Permission::firstOrCreate(['name' => 'ticket.view']);
        Permission::firstOrCreate(['name' => 'ticket.delete']);
        Permission::firstOrCreate(['name' => 'ticket.assign']);
        Permission::firstOrCreate(['name' => 'ticket.status']);
        Permission::firstOrCreate(['name' => 'ticket.priority']);


        Role::firstOrCreate(['name' => User::SUPER_ADMIN_ROLE]); // SuperAdmin get all permissions 

        $adminRole = Role::firstOrCreate(['name' => User::ADMIN_ROLE]);

        $userRole = Role::firstOrCreate(['name' => User::USER_ROLE]);

        $supportAgent = Role::firstOrCreate(['name' => User::SUPPORT_AGENT_ROLE]);

        $adminRole->givePermissionTo([
            'user.create',
            'user.view',
            'user.update',
            // 'user.delete',
            'category.create',
            'category.view',
            'category.update',
            // 'category.delete',
            'ticket.view',
            // 'ticket.delete',
            'ticket.assign',
            'ticket.status',
            'ticket.priority'
        ]);

        $userRole->givePermissionTo([
            'ticket.view',
        ]);

        $supportAgent->givePermissionTo([
            'ticket.view',
            'ticket.status',
        ]);
    }
}
