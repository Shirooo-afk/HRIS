<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_admin_can_access_dashboard_and_employee_directory(): void
    {
        $admin = User::where('role', 'admin')->first();

        $response = $this->actingAs($admin)->get('/dashboard');
        $response->assertRedirect(route('dashboard.admin'));

        $adminView = $this->actingAs($admin)->get(route('dashboard.admin'));
        $adminView->assertStatus(200);

        $employeesView = $this->actingAs($admin)->get(route('employees.index'));
        $employeesView->assertStatus(200);
    }

    public function test_hr_can_access_operations(): void
    {
        $hr = User::where('role', 'hr')->first();

        $hrView = $this->actingAs($hr)->get(route('dashboard.hr'));
        $hrView->assertStatus(200);

        $attendanceView = $this->actingAs($hr)->get(route('hr.attendance'));
        $attendanceView->assertStatus(200);

        $payrollView = $this->actingAs($hr)->get(route('hr.payroll'));
        $payrollView->assertStatus(200);
    }
}
