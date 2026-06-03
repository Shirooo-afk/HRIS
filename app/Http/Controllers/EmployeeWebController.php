<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentStatus;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmployeeWebController extends Controller
{
    public function index(): View
    {
        $employees = Employee::query()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        return view('employees.create', [
            'statuses' => EmploymentStatus::cases(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        Employee::query()->create([
            ...$validated,
            'status' => $validated['status'] ?? EmploymentStatus::Active,
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee added successfully.');
    }

    public function edit(Employee $employee): View
    {
        return view('employees.edit', [
            'employee' => $employee,
            'statuses' => EmploymentStatus::cases(),
        ]);
    }

    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validate($this->rules($employee));

        $employee->update($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->update(['status' => EmploymentStatus::Terminated]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee marked as terminated.');
    }

    /** @return array<string, mixed> */
    private function rules(?Employee $employee = null): array
    {
        return [
            'employee_number' => [
                'required', 'string', 'max:50',
                Rule::unique('employees', 'employee_number')->ignore($employee?->id),
            ],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('employees', 'email')->ignore($employee?->id),
            ],
            'department' => ['required', 'string', 'max:100'],
            'job_title' => ['required', 'string', 'max:100'],
            'hire_date' => ['required', 'date'],
            'status' => ['required', Rule::enum(EmploymentStatus::class)],
        ];
    }
}
