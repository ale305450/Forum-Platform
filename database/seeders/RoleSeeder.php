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

        $admin->givePermissionTo([]);

        //Create user role and assgin permission to it

        $user = Role::create(['name' => 'User']);

        $user->givePermissionTo([]);
    }
}
