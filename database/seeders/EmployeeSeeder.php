<?php

namespace Database\Seeders;

use App\Enums\EmploymentStatus;
use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            [
                'employee_number' => 'EMP-001',
                'first_name' => 'Alice',
                'last_name' => 'Nguyen',
                'email' => 'alice.nguyen@contoso.com',
                'department' => 'Engineering',
                'job_title' => 'Lead Software Engineer',
                'hire_date' => '2024-03-15',
                'status' => EmploymentStatus::Active,
            ],
            [
                'employee_number' => 'EMP-002',
                'first_name' => 'Marcus',
                'last_name' => 'Reed',
                'email' => 'marcus.reed@contoso.com',
                'department' => 'Human Resources',
                'job_title' => 'HR Generalist',
                'hire_date' => '2022-09-01',
                'status' => EmploymentStatus::Active,
            ],
            [
                'employee_number' => 'EMP-003',
                'first_name' => 'Sophia',
                'last_name' => 'Chen',
                'email' => 'sophia.chen@contoso.com',
                'department' => 'Product Design',
                'job_title' => 'Senior UI/UX Designer',
                'hire_date' => '2023-01-10',
                'status' => EmploymentStatus::Active,
            ],
            [
                'employee_number' => 'EMP-004',
                'first_name' => 'David',
                'last_name' => 'Kim',
                'email' => 'david.kim@contoso.com',
                'department' => 'Sales',
                'job_title' => 'Account Executive',
                'hire_date' => '2023-06-20',
                'status' => EmploymentStatus::OnLeave,
            ],
            [
                'employee_number' => 'EMP-005',
                'first_name' => 'Elena',
                'last_name' => 'Rostova',
                'email' => 'elena.rostova@contoso.com',
                'department' => 'Marketing',
                'job_title' => 'Brand Strategy Lead',
                'hire_date' => '2022-11-15',
                'status' => EmploymentStatus::Active,
            ],
        ];

        foreach ($employees as $data) {
            Employee::query()->updateOrCreate(
                ['employee_number' => $data['employee_number']],
                $data
            );
        }

        $emp1 = Employee::where('employee_number', 'EMP-001')->first();
        $emp2 = Employee::where('employee_number', 'EMP-002')->first();
        $emp3 = Employee::where('employee_number', 'EMP-003')->first();

        // Sample Attendance records
        if ($emp1 && Attendance::where('employee_id', $emp1->id)->doesntExist()) {
            Attendance::create([
                'employee_id' => $emp1->id,
                'date' => now()->toDateString(),
                'time_in' => '08:55:00',
                'time_out' => '17:30:00',
                'status' => 'present',
            ]);
        }
        if ($emp2 && Attendance::where('employee_id', $emp2->id)->doesntExist()) {
            Attendance::create([
                'employee_id' => $emp2->id,
                'date' => now()->toDateString(),
                'time_in' => '09:12:00',
                'time_out' => '18:05:00',
                'status' => 'late',
            ]);
        }
        if ($emp3 && Attendance::where('employee_id', $emp3->id)->doesntExist()) {
            Attendance::create([
                'employee_id' => $emp3->id,
                'date' => now()->toDateString(),
                'time_in' => '08:45:00',
                'time_out' => '17:15:00',
                'status' => 'present',
            ]);
        }

        // Sample Leave Requests
        if ($emp1 && LeaveRequest::where('employee_id', $emp1->id)->doesntExist()) {
            LeaveRequest::create([
                'employee_id' => $emp1->id,
                'leave_type' => 'vacation',
                'start_date' => now()->addDays(5)->toDateString(),
                'end_date' => now()->addDays(9)->toDateString(),
                'reason' => 'Annual family vacation trip.',
                'status' => 'pending',
            ]);
        }
        if ($emp3 && LeaveRequest::where('employee_id', $emp3->id)->doesntExist()) {
            LeaveRequest::create([
                'employee_id' => $emp3->id,
                'leave_type' => 'sick',
                'start_date' => now()->subDays(3)->toDateString(),
                'end_date' => now()->subDays(2)->toDateString(),
                'reason' => 'Medical appointment and recovery.',
                'status' => 'approved',
            ]);
        }

        // Sample Payroll
        if ($emp1 && Payroll::where('employee_id', $emp1->id)->doesntExist()) {
            Payroll::create([
                'employee_id' => $emp1->id,
                'basic_salary' => 6500.00,
                'bonuses' => 500.00,
                'deductions' => 450.00,
                'net_salary' => 6550.00,
                'pay_date' => now()->startOfMonth()->toDateString(),
            ]);
        }
        if ($emp2 && Payroll::where('employee_id', $emp2->id)->doesntExist()) {
            Payroll::create([
                'employee_id' => $emp2->id,
                'basic_salary' => 4800.00,
                'bonuses' => 200.00,
                'deductions' => 320.00,
                'net_salary' => 4680.00,
                'pay_date' => now()->startOfMonth()->toDateString(),
            ]);
        }

        // Sample Announcements
        if (Announcement::count() === 0) {
            Announcement::create([
                'title' => 'Q4 All-Hands Meeting & Performance Review Schedule',
                'content' => 'The quarterly all-hands meeting will be hosted this Friday at 3:00 PM. All team leads are requested to finalize annual goals.',
            ]);
            Announcement::create([
                'title' => 'Updated Healthcare Benefits & Open Enrollment',
                'content' => 'Open enrollment for extended health, dental, and wellness allowances is now live through the end of the month.',
            ]);
        }
    }
}
