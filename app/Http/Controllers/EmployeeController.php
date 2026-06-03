<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentStatus;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(): JsonResponse
    {
        $employees = Employee::query()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return response()->json(['data' => $employees]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'employee_number' => ['required', 'string', 'max:50', 'unique:employees,employee_number'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:employees,email'],
            'department' => ['required', 'string', 'max:100'],
            'job_title' => ['required', 'string', 'max:100'],
            'hire_date' => ['required', 'date'],
            'status' => ['sometimes', Rule::enum(EmploymentStatus::class)],
        ]);

        $employee = Employee::query()->create([
            ...$validated,
            'status' => $validated['status'] ?? EmploymentStatus::Active,
        ]);

        return response()->json(['data' => $employee], 201);
    }

    public function show(Employee $employee): JsonResponse
    {
        return response()->json(['data' => $employee]);
    }

    public function update(Request $request, Employee $employee): JsonResponse
    {
        $validated = $request->validate([
            'employee_number' => ['sometimes', 'string', 'max:50', Rule::unique('employees', 'employee_number')->ignore($employee->id)],
            'first_name' => ['sometimes', 'string', 'max:100'],
            'last_name' => ['sometimes', 'string', 'max:100'],
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('employees', 'email')->ignore($employee->id)],
            'department' => ['sometimes', 'string', 'max:100'],
            'job_title' => ['sometimes', 'string', 'max:100'],
            'hire_date' => ['sometimes', 'date'],
            'status' => ['sometimes', Rule::enum(EmploymentStatus::class)],
        ]);

        $employee->update($validated);

        return response()->json(['data' => $employee->fresh()]);
    }

    public function destroy(Employee $employee): JsonResponse
    {
        $employee->update(['status' => EmploymentStatus::Terminated]);

        return response()->json(['data' => $employee->fresh()]);
    }
}
