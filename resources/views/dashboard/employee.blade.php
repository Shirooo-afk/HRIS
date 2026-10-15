@extends('layouts.app')

@section('title', 'My Employee Workspace')
@section('subtitle', 'Your personal staff profile, tasks, and company announcements.')

@section('content')
<!-- Hero Welcome Banner -->
<div class="card" style="background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%); color: #ffffff; padding: 2rem; border-radius: 24px; margin-bottom: 1.5rem; box-shadow: 0 16px 36px rgba(30, 41, 59, 0.2); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
    <div style="max-width: 600px;">
        <span class="badge" style="background: rgba(255, 255, 255, 0.15); color: #f1f5f9; font-weight: 600; padding: 0.35rem 0.85rem; border-radius: 999px; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">
            💼 Employee Portal
        </span>
        <h2 style="font-size: 1.85rem; font-weight: 800; margin: 0.85rem 0 0.5rem; color: #ffffff; letter-spacing: -0.02em;">
            Welcome, {{ auth()->user()->name }}!
        </h2>
        <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.5; margin: 0;">
            Here is your daily portal. You can view company personnel, check corporate announcements, and verify your profile details.
        </p>
    </div>
    <div>
        <a href="{{ route('employees.index') }}" class="btn btn-primary" style="background: #ffffff; color: #1e293b; font-weight: 700; box-shadow: 0 4px 14px rgba(0,0,0,0.15);">
            Browse Company Directory
        </a>
    </div>
</div>

<!-- Employee Details Cards -->
<div class="grid stats-grid" style="margin-bottom: 1.5rem;">
    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #3b82f6; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Work Account</span>
        <strong style="display: block; font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0.5rem 0 0.25rem; word-break: break-all;">
            {{ auth()->user()->email }}
        </strong>
        <p style="margin: 0.35rem 0 0; color: #64748b; font-size: 0.85rem;">Official email address</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #10b981; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Account Status</span>
        <strong style="display: block; font-size: 1.5rem; font-weight: 800; color: #15803d; margin: 0.5rem 0 0.25rem;">
            Active Member
        </strong>
        <p style="margin: 0.35rem 0 0; color: #64748b; font-size: 0.85rem;">Role: {{ ucfirst(auth()->user()->role) }}</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #8b5cf6; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Company Portal</span>
        <strong style="display: block; font-size: 1.5rem; font-weight: 800; color: #6d28d9; margin: 0.5rem 0 0.25rem;">
            HRIS Online
        </strong>
        <p style="margin: 0.35rem 0 0; color: #64748b; font-size: 0.85rem;">Connected to central system</p>
    </div>
</div>
@endsection
