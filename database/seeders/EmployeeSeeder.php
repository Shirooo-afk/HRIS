<?php

namespace Database\Seeders;

use App\Enums\EmploymentStatus;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        Employee::query()->updateOrCreate(
            ['employee_number' => 'EMP-001'],
            [
                'first_name' => 'Alice',
                'last_name' => 'Nguyen',
                'email' => 'alice.nguyen@contoso.com',
                'department' => 'Engineering',
                'job_title' => 'Software Engineer',
                'hire_date' => '2024-03-15',
                'status' => EmploymentStatus::Active,
            ]
        );

        Employee::query()->updateOrCreate(
            ['employee_number' => 'EMP-002'],
            [
                'first_name' => 'Marcus',
                'last_name' => 'Reed',
                'email' => 'marcus.reed@contoso.com',
                'department' => 'Human Resources',
                'job_title' => 'HR Generalist',
                'hire_date' => '2022-09-01',
                'status' => EmploymentStatus::Active,
            ]
        );
    }
}
