@extends('layouts.app')

@section('title', 'Admin Overview')
@section('subtitle', 'Complete workforce control panel and system statistics.')

@section('content')
<!-- Hero Welcome Banner -->
<div class="card" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%); color: #ffffff; padding: 2rem; border-radius: 24px; margin-bottom: 1.5rem; box-shadow: 0 16px 36px rgba(49, 46, 129, 0.25); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
    <div style="max-width: 600px;">
        <span class="badge" style="background: rgba(255, 255, 255, 0.15); color: #e0e7ff; font-weight: 600; padding: 0.35rem 0.85rem; border-radius: 999px; font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase;">
            👑 Administrator Portal
        </span>
        <h2 style="font-size: 1.85rem; font-weight: 800; margin: 0.85rem 0 0.5rem; color: #ffffff; letter-spacing: -0.02em;">
            Welcome back, {{ auth()->user()->name }}!
        </h2>
        <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.5; margin: 0;">
            Here is your daily overview. You can manage personnel, audit attendance records, approve operations, or export data via the API.
        </p>
    </div>
    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
        <a href="{{ route('employees.create') }}" class="btn btn-primary" style="background: #ffffff; color: #312e81; font-weight: 700; box-shadow: 0 4px 14px rgba(0,0,0,0.15);">
            + Onboard Employee
        </a>
        <a href="{{ route('employees.index') }}" class="btn" style="background: rgba(255, 255, 255, 0.12); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.2); font-weight: 600;">
            View Directory
        </a>
    </div>
</div>

<!-- Key Stat Cards -->
<div class="grid stats-grid" style="margin-bottom: 1.5rem;">
    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #4f46e5; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Total Personnel</span>
                <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #0f172a; margin: 0.35rem 0 0.25rem;">{{ $totalEmployees }}</strong>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #e0e7ff; color: #4338ca; display: grid; place-items: center; font-size: 1.25rem;">
                👥
            </div>
        </div>
        <p style="margin: 0.5rem 0 0; color: #64748b; font-size: 0.85rem;">Registered workforce members</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #10b981; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Active Staff</span>
                <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #15803d; margin: 0.35rem 0 0.25rem;">{{ $activeEmployees }}</strong>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #dcfce7; color: #15803d; display: grid; place-items: center; font-size: 1.25rem;">
                ✅
            </div>
        </div>
        <p style="margin: 0.5rem 0 0; color: #64748b; font-size: 0.85rem;">Currently on duty & active payroll</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #ef4444; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Terminated</span>
                <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #b91c1c; margin: 0.35rem 0 0.25rem;">{{ $terminatedEmployees }}</strong>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #fee2e2; color: #b91c1c; display: grid; place-items: center; font-size: 1.25rem;">
                🛑
            </div>
        </div>
        <p style="margin: 0.5rem 0 0; color: #64748b; font-size: 0.85rem;">Archived former staff</p>
    </div>
</div>

<!-- Operations Quick Panel -->
<div class="grid panel-grid">
    <div class="card" style="padding: 1.5rem; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; padding-bottom: 0.75rem; border-bottom: 1px solid #e2e8f0;">
            <h3 style="margin: 0; font-size: 1.1rem; color: #0f172a; font-weight: 700;">HR Operations Center</h3>
            <span style="font-size: 0.8rem; color: #64748b;">Shortcuts</span>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <a href="{{ route('hr.attendance') }}" style="display: flex; align-items: center; gap: 0.85rem; padding: 1rem; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; color: inherit; transition: all 0.2s;">
                <span style="font-size: 1.5rem;">⏱️</span>
                <div>
                    <strong style="display: block; color: #1e293b; font-size: 0.95rem;">Attendance</strong>
                    <span style="color: #64748b; font-size: 0.8rem;">Review check-ins & status</span>
                </div>
            </a>

            <a href="{{ route('hr.leave_requests') }}" style="display: flex; align-items: center; gap: 0.85rem; padding: 1rem; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; color: inherit; transition: all 0.2s;">
                <span style="font-size: 1.5rem;">🌴</span>
                <div>
                    <strong style="display: block; color: #1e293b; font-size: 0.95rem;">Leave Requests</strong>
                    <span style="color: #64748b; font-size: 0.8rem;">Approve & review applications</span>
                </div>
            </a>

            <a href="{{ route('hr.payroll') }}" style="display: flex; align-items: center; gap: 0.85rem; padding: 1rem; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; color: inherit; transition: all 0.2s;">
                <span style="font-size: 1.5rem;">💰</span>
                <div>
                    <strong style="display: block; color: #1e293b; font-size: 0.95rem;">Payroll</strong>
                    <span style="color: #64748b; font-size: 0.8rem;">Salary distributions & logs</span>
                </div>
            </a>

            <a href="{{ route('hr.reports') }}" style="display: flex; align-items: center; gap: 0.85rem; padding: 1rem; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0; text-decoration: none; color: inherit; transition: all 0.2s;">
                <span style="font-size: 1.5rem;">📈</span>
                <div>
                    <strong style="display: block; color: #1e293b; font-size: 0.95rem;">Reports</strong>
                    <span style="color: #64748b; font-size: 0.8rem;">Operational summaries</span>
                </div>
            </a>
        </div>
    </div>

    <!-- System Highlights Card -->
    <div class="card" style="padding: 1.5rem; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <h3 style="margin: 0 0 1rem; font-size: 1.1rem; color: #0f172a; font-weight: 700;">System Health</h3>
        
        <div style="display: flex; flex-direction: column; gap: 0.85rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 10px;">
                <span style="color: #475569; font-size: 0.85rem;">Environment</span>
                <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 700;">Local / SQLite</span>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 10px;">
                <span style="color: #475569; font-size: 0.85rem;">Framework</span>
                <span class="badge" style="background: #eef2ff; color: #4338ca; font-weight: 700;">Laravel 12</span>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 10px;">
                <span style="color: #475569; font-size: 0.85rem;">API Status</span>
                <span class="badge" style="background: #dcfce7; color: #15803d; font-weight: 700;">● Online</span>
            </div>
        </div>
    </div>
</div>
@endsection
