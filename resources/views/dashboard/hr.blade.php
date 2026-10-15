@extends('layouts.app')

@section('title', 'HR Staff Workspace')
@section('subtitle', 'Workforce directory, attendance audits, and pending leave reviews.')

@section('content')
<!-- Hero Welcome Banner -->
<div class="card" style="background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%); color: #ffffff; padding: 2rem; border-radius: 24px; margin-bottom: 1.5rem; box-shadow: 0 16px 36px rgba(6, 95, 70, 0.25); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
    <div style="max-width: 600px;">
        <span class="badge" style="background: rgba(255, 255, 255, 0.15); color: #d1fae5; font-weight: 600; padding: 0.35rem 0.85rem; border-radius: 999px; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">
            👥 HR Staff Portal
        </span>
        <h2 style="font-size: 1.85rem; font-weight: 800; margin: 0.85rem 0 0.5rem; color: #ffffff; letter-spacing: -0.02em;">
            Welcome, {{ auth()->user()->name }}!
        </h2>
        <p style="color: #a7f3d0; font-size: 0.95rem; line-height: 1.5; margin: 0;">
            Manage employee onboarding, monitor check-in punctuality, and process time-off applications quickly and smoothly.
        </p>
    </div>
    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
        <a href="{{ route('employees.create') }}" class="btn btn-primary" style="background: #ffffff; color: #065f46; font-weight: 700; box-shadow: 0 4px 14px rgba(0,0,0,0.15);">
            + Onboard Employee
        </a>
        <a href="{{ route('hr.leave_requests') }}" class="btn" style="background: rgba(255, 255, 255, 0.12); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 600;">
            Review Leaves
        </a>
    </div>
</div>

<!-- Stat Cards -->
<div class="grid stats-grid" style="margin-bottom: 1.5rem;">
    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #10b981; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Total Personnel</span>
                <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #0f172a; margin: 0.35rem 0 0.25rem;">{{ $totalEmployees }}</strong>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #dcfce7; color: #15803d; display: grid; place-items: center; font-size: 1.25rem;">
                👥
            </div>
        </div>
        <p style="margin: 0.5rem 0 0; color: #64748b; font-size: 0.85rem;">Company headcount</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #3b82f6; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Active Roster</span>
                <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #1d4ed8; margin: 0.35rem 0 0.25rem;">{{ $activeEmployees }}</strong>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #dbeafe; color: #1d4ed8; display: grid; place-items: center; font-size: 1.25rem;">
                ⚡
            </div>
        </div>
        <p style="margin: 0.5rem 0 0; color: #64748b; font-size: 0.85rem;">Staff actively working</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #f59e0b; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Pending Leaves</span>
                <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #b45309; margin: 0.35rem 0 0.25rem;">{{ $pendingLeaves }}</strong>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #fef3c7; color: #b45309; display: grid; place-items: center; font-size: 1.25rem;">
                🌴
            </div>
        </div>
        <p style="margin: 0.5rem 0 0; color: #64748b; font-size: 0.85rem;">Awaiting your approval</p>
    </div>
</div>

<!-- Operations Quick Panel -->
<div class="grid panel-grid">
    <div class="card" style="padding: 1.5rem; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <h3 style="margin: 0 0 1.25rem; font-size: 1.1rem; color: #0f172a; font-weight: 700;">HR Operations</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <a href="{{ route('hr.attendance') }}" style="display: flex; align-items: center; gap: 0.85rem; padding: 1rem; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; color: inherit;">
                <span style="font-size: 1.5rem;">⏱️</span>
                <div>
                    <strong style="display: block; color: #1e293b; font-size: 0.95rem;">Attendance</strong>
                    <span style="color: #64748b; font-size: 0.8rem;">Daily time logs</span>
                </div>
            </a>
            <a href="{{ route('hr.leave_requests') }}" style="display: flex; align-items: center; gap: 0.85rem; padding: 1rem; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; color: inherit;">
                <span style="font-size: 1.5rem;">🌴</span>
                <div>
                    <strong style="display: block; color: #1e293b; font-size: 0.95rem;">Leave Requests</strong>
                    <span style="color: #64748b; font-size: 0.8rem;">Approve applications</span>
                </div>
            </a>
            <a href="{{ route('hr.payroll') }}" style="display: flex; align-items: center; gap: 0.85rem; padding: 1rem; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; color: inherit;">
                <span style="font-size: 1.5rem;">💰</span>
                <div>
                    <strong style="display: block; color: #1e293b; font-size: 0.95rem;">Payroll</strong>
                    <span style="color: #64748b; font-size: 0.8rem;">View payout records</span>
                </div>
            </a>
            <a href="{{ route('hr.reports') }}" style="display: flex; align-items: center; gap: 0.85rem; padding: 1rem; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; color: inherit;">
                <span style="font-size: 1.5rem;">📈</span>
                <div>
                    <strong style="display: block; color: #1e293b; font-size: 0.95rem;">Reports</strong>
                    <span style="color: #64748b; font-size: 0.8rem;">Workforce summaries</span>
                </div>
            </a>
        </div>
    </div>

    <div class="card" style="padding: 1.5rem; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <h3 style="margin: 0 0 1rem; font-size: 1.1rem; color: #0f172a; font-weight: 700;">HR Tips</h3>
        <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin: 0 0 1rem;">
            Maintain accurate staff records to ensure automated reports and payroll reflect real-time attendance and status.
        </p>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-block" style="text-align: center; border-radius: 10px;">
            Open Staff Directory
        </a>
    </div>
</div>
@endsection
