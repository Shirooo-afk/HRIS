@extends('layouts.app')

@section('title', 'Workforce Analytics & Reports')
@section('subtitle', 'High-level executive summaries and operational HR health indicators.')

@section('content')
<div class="grid stats-grid" style="margin-bottom: 1.5rem;">
    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #4f46e5; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Total Personnel</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #0f172a; margin: 0.35rem 0 0.25rem;">{{ $totalEmployees }}</strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Registered staff members</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #10b981; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Approved Leaves</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #15803d; margin: 0.35rem 0 0.25rem;">{{ $approvedLeaves }}</strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Time-off requests granted</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #f59e0b; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Pending Leaves</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #b45309; margin: 0.35rem 0 0.25rem;">{{ $pendingLeaves }}</strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Applications in queue</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #06b6d4; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Payroll Batches</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #0891b2; margin: 0.35rem 0 0.25rem;">{{ $payrollCount }}</strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Disbursement cycles executed</p>
    </div>
</div>

<div class="card" style="padding: 1.75rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #f1f5f9;">
    <h3 style="margin: 0 0 0.75rem; font-size: 1.15rem; color: #0f172a; font-weight: 700;">Operational Insights</h3>
    <p style="color: #475569; font-size: 0.95rem; line-height: 1.6; margin: 0 0 1.5rem;">
        Workforce telemetry is aggregated automatically across all departments. Use the operations shortcuts below to inspect detailed attendance, leave, or payroll data.
    </p>

    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
        <a href="{{ route('hr.attendance') }}" class="btn btn-secondary" style="border-radius: 12px; font-weight: 600;">
            ⏱️ Inspect Attendance Logs
        </a>
        <a href="{{ route('hr.leave_requests') }}" class="btn btn-secondary" style="border-radius: 12px; font-weight: 600;">
            🌴 Review Leave Submissions
        </a>
        <a href="{{ route('hr.payroll') }}" class="btn btn-secondary" style="border-radius: 12px; font-weight: 600;">
            💰 Audit Payroll Runs
        </a>
    </div>
</div>
@endsection
