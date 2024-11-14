<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create admin role and assgin permission to it
        $admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'create-category',
            'update-category',
            'delete-category',
            'all-topics',
            'all-users',
            'find-user',
            'show-user',
            'delete-user',
        ]);

        //Create user role and assgin permission to it

        $user = Role::create(['name' => 'User']);

        $user->givePermissionTo([
            'create-response',
            'update-response',
            'delete-response',
            'all-topics',
            'create-topic',
            'update-topic',
            'delete-topic',
            'find-user',
            'show-user',
        ]);
    }
}
