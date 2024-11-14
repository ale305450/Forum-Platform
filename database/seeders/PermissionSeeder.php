<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-category',
            'update-category',
            'delete-category',

            'create-response',
            'update-response',
            'delete-response',

            'all-topics',
            'create-topic',
            'update-topic',
            'delete-topic',

            'all-users',
            'find-user',
            'show-user',
            'delete-user',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
