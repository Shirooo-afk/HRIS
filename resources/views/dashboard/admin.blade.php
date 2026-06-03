@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="card" style="padding: 2rem;">
        <h2 class="page-title">Admin Dashboard</h2>

        <p style="margin-bottom: 1rem; color: #475569;">Welcome back, {{ auth()->user()->name }}. Use this dashboard to review workforce metrics and manage employee records.</p>

        <div style="display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom: 1.5rem;">
            <div class="card" style="padding: 1.25rem; background: #eff6ff; border: 1px solid #c7d2fe;">
                <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">Total employees</h3>
                <p style="font-size: 2rem; margin: 0; font-weight: 700;">{{ $totalEmployees }}</p>
            </div>
            <div class="card" style="padding: 1.25rem; background: #ecfdf5; border: 1px solid #bbf7d0;">
                <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">Active employees</h3>
                <p style="font-size: 2rem; margin: 0; font-weight: 700;">{{ $activeEmployees }}</p>
            </div>
            <div class="card" style="padding: 1.25rem; background: #fef2f2; border: 1px solid #fecaca;">
                <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">Terminated employees</h3>
                <p style="font-size: 2rem; margin: 0; font-weight: 700;">{{ $terminatedEmployees }}</p>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
            <a href="{{ route('employees.index') }}" class="btn btn-primary">View employee list</a>
            <a href="{{ route('employees.create') }}" class="btn btn-secondary">Add a new employee</a>
        </div>
    </div>
@endsection
