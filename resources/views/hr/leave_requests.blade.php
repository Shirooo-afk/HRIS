@extends('layouts.app')

@section('title', 'Leave Management')
@section('subtitle', 'Review, approve, or decline employee time-off and vacation requests.')

@section('content')
<div class="grid stats-grid" style="margin-bottom: 1.5rem;">
    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #f59e0b; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Pending Review</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #b45309; margin: 0.35rem 0 0.25rem;">
            {{ $leaveSummary['pending'] ?? 0 }}
        </strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Applications awaiting HR approval</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #10b981; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Approved Leaves</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #15803d; margin: 0.35rem 0 0.25rem;">
            {{ $leaveSummary['approved'] ?? 0 }}
        </strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Approved for current cycle</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #ef4444; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Declined</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #b91c1c; margin: 0.35rem 0 0.25rem;">
            {{ $leaveSummary['denied'] ?? 0 }}
        </strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Rejected requests</p>
    </div>
</div>

<div class="card" style="padding: 1.5rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #f1f5f9;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
        <h3 style="margin: 0; font-size: 1.15rem; color: #0f172a; font-weight: 700;">Pending Applications</h3>
        <span class="badge" style="background: #fef3c7; color: #b45309; font-weight: 600;">
            {{ $pendingLeaves->count() }} Waiting
        </span>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Applicant</th>
                    <th>Leave Type</th>
                    <th>Schedule Duration</th>
                    <th>Reason / Details</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendingLeaves as $request)
                    <tr>
                        <td>
                            <strong>{{ $request->employee?->first_name }} {{ $request->employee?->last_name }}</strong>
                        </td>
                        <td>
                            <span class="badge" style="background: #eef2ff; color: #4338ca; font-weight: 600;">
                                {{ ucfirst($request->leave_type) }}
                            </span>
                        </td>
                        <td>
                            <span style="color: #334155; font-weight: 500;">
                                {{ $request->start_date }} → {{ $request->end_date }}
                            </span>
                        </td>
                        <td>
                            <span style="color: #64748b;">{{ Str::limit($request->reason, 60) }}</span>
                        </td>
                        <td>
                            <span class="badge" style="background: #fef3c7; color: #b45309; font-weight: 700;">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty" style="padding: 2.5rem; text-align: center; color: #64748b;">
                            🌴 All caught up! There are no pending leave requests to review.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
