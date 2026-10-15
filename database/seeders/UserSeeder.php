<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@hris.test'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'employee@hris.test'],
            [
                'name' => 'Employee User',
                'username' => 'employee',
                'password' => bcrypt('password'),
                'role' => 'employee',
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'hr@hris.test'],
            [
                'name' => 'HR Staff',
                'username' => 'hrstaff',
                'password' => bcrypt('password'),
                'role' => 'hr',
            ]
        );
    }
}
