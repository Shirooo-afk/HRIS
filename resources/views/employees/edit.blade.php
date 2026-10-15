@extends('layouts.app')

@section('title', 'Edit Employee Profile')
@section('subtitle', 'Update information and employment status for ' . $employee->first_name . ' ' . $employee->last_name . '.')

@section('content')
<div class="card" style="max-width: 860px; margin: 0 auto; padding: 2rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #f1f5f9;">
    <div style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 0.85rem;">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); color: #ffffff; display: grid; place-items: center; font-weight: 700; font-size: 1.1rem;">
                {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
            </div>
            <div>
                <h3 style="margin: 0; color: #0f172a; font-weight: 700; font-size: 1.25rem;">{{ $employee->first_name }} {{ $employee->last_name }}</h3>
                <p style="margin: 0.15rem 0 0; color: #64748b; font-size: 0.85rem;">Employee ID: {{ $employee->employee_number }}</p>
            </div>
        </div>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm" style="padding: 0.45rem 0.85rem;">
            ← Back to Directory
        </a>
    </div>

    <form action="{{ route('employees.update', $employee) }}" method="post">
        @csrf
        @method('PUT')
        @include('employees._form', ['employee' => $employee])
        
        <div class="form-actions" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 0.75rem;">
            <a href="{{ route('employees.index') }}" class="btn btn-secondary" style="padding: 0.75rem 1.25rem;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.75rem; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);">
                Update Employee Details
            </button>
        </div>
    </form>
</div>
@endsection
