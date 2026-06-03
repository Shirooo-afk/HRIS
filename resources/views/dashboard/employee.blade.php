@extends('layouts.app')

@section('title', 'Employee Dashboard')

@section('content')
    <div class="card" style="padding: 2rem; max-width: 760px; margin: 0 auto;">
        <h2 class="page-title">Employee Dashboard</h2>

        <p style="margin-bottom: 1rem; color: #475569;">
            Hello, {{ auth()->user()->name }}. This space is your personal dashboard for HRIS.
        </p>

        <div style="display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom: 1.5rem;">
            <div class="card" style="padding: 1.25rem; background: #eff6ff; border: 1px solid #c7d2fe;">
                <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">Profile</h3>
                <p style="margin: 0; line-height: 1.6;">Email: {{ auth()->user()->email }}</p>
                <p style="margin: 0; line-height: 1.6;">Role: {{ ucfirst(auth()->user()->role) }}</p>
            </div>
            <div class="card" style="padding: 1.25rem; background: #f8fafc; border: 1px solid #e2e8f0;">
                <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">Quick actions</h3>
                <ul style="padding-left: 1.25rem; margin: 0; color: #334155;">
                    <li>View employee directory</li>
                    <li>Update your account settings</li>
                    <li>Contact HR for profile updates</li>
                </ul>
            </div>
        </div>

        <p style="margin-bottom: 1rem; color: #475569;">If you need to manage employee records or review company data, contact your administrator.</p>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Browse employee list</a>
    </div>
@endsection
