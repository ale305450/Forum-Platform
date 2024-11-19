<?php

namespace Database\Seeders;

use App\Core\Entities\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'admin',
                'email_verified_at' => now(),
            ]
        )->assignRole('Admin');
    }
}
