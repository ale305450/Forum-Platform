<?php

namespace Database\Seeders;

use App\Core\Entities\User as EntitiesUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = EntitiesUser::factory(10)->create();
        foreach ($users as $user) {
            $user->assignRole('User');
        }
    }
}
