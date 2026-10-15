@extends('layouts.app')

@section('title', 'Employee Directory')
@section('subtitle', 'Manage, view, and organize company staff profiles and employment statuses.')

@section('content')
<div class="card" style="box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #f1f5f9; padding: 1.5rem;">
    <!-- Controls Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; padding-bottom: 1.25rem; border-bottom: 1px solid #e2e8f0;">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div style="font-weight: 700; font-size: 1.15rem; color: #0f172a;">
                All Personnel
            </div>
            <span class="badge" style="background: #eef2ff; color: #4338ca; font-weight: 700; font-size: 0.8rem; padding: 0.35rem 0.75rem;">
                {{ $employees->count() }} Total
            </span>
        </div>

        <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
            <a href="{{ route('employees.create') }}" class="btn btn-primary" style="padding: 0.75rem 1.25rem; font-size: 0.9rem; font-weight: 600; border-radius: 12px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);">
                <span>+</span> Add New Employee
            </a>
        </div>
    </div>

    @if ($employees->isEmpty())
        <div class="empty" style="padding: 3.5rem 1rem;">
            <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">👥</div>
            <h3 style="color: #1e293b; margin: 0 0 0.5rem; font-weight: 700;">No employees registered yet</h3>
            <p style="color: #64748b; margin: 0 0 1.5rem; max-width: 400px; margin-inline: auto;">
                Start onboarding your team members into the system to begin tracking attendance, payroll, and leave requests.
            </p>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                + Add the first employee
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">Employee</th>
                        <th>ID Number</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Hire Date</th>
                        <th>Status</th>
                        <th style="text-align: right; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.85rem;">
                                    <div style="width: 38px; height: 38px; border-radius: 12px; background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); color: #ffffff; display: grid; place-items: center; font-weight: 700; font-size: 0.85rem; flex-shrink: 0; box-shadow: 0 2px 6px rgba(79, 70, 229, 0.2);">
                                        {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </div>
                                        <div style="color: #64748b; font-size: 0.8rem;">
                                            {{ $employee->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-family: monospace; font-weight: 600; color: #334155; background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.85rem;">
                                    {{ $employee->employee_number }}
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #1e293b;">{{ $employee->department }}</span>
                            </td>
                            <td>
                                <span style="color: #475569;">{{ $employee->job_title }}</span>
                            </td>
                            <td>
                                <span style="color: #64748b; font-size: 0.88rem;">
                                    {{ $employee->hire_date ? $employee->hire_date->format('M d, Y') : '—' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusValue = $employee->status?->value ?? 'active';
                                    $badgeStyles = match($statusValue) {
                                        'active' => 'background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;',
                                        'on_leave' => 'background: #fef3c7; color: #b45309; border: 1px solid #fde68a;',
                                        'terminated' => 'background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca;',
                                        default => 'background: #f1f5f9; color: #475569;'
                                    };
                                @endphp
                                <span class="badge" style="{{ $badgeStyles }} font-weight: 700; text-transform: capitalize; padding: 0.35rem 0.75rem;">
                                    {{ str_replace('_', ' ', $statusValue) }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div class="actions" style="justify-content: flex-end;">
                                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-secondary btn-sm" style="border-radius: 8px; padding: 0.45rem 0.85rem; font-weight: 600;">
                                        ✏️ Edit
                                    </a>
                                    @if ($employee->status !== \App\Enums\EmploymentStatus::Terminated)
                                        <form action="{{ route('employees.destroy', $employee) }}" method="post" style="display: inline;"
                                              onsubmit="return confirm('Are you sure you want to mark {{ $employee->first_name }} {{ $employee->last_name }} as terminated?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 8px; padding: 0.45rem 0.85rem; font-weight: 600; background: #ef4444;">
                                                Terminate
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
