@extends('layouts.app')

@section('title', 'Employees')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
        <h2 class="page-title" style="margin: 0;">Employees</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">+ Add employee</a>
    </div>

    <div class="card">
        @if ($employees->isEmpty())
            <p class="empty">No employees yet. <a href="{{ route('employees.create') }}">Add the first employee</a>.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Job title</th>
                        <th>Hire date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->employee_number }}</td>
                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>{{ $employee->job_title }}</td>
                            <td>{{ $employee->hire_date->format('M j, Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $employee->status->value }}">
                                    {{ str_replace('_', ' ', ucfirst($employee->status->value)) }}
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    @if ($employee->status !== \App\Enums\EmploymentStatus::Terminated)
                                        <form action="{{ route('employees.destroy', $employee) }}" method="post" style="display: inline;"
                                              onsubmit="return confirm('Mark this employee as terminated?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Terminate</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
