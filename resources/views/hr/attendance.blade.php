@extends('layouts.app')

@section('title', 'Time Attendance Tracking')
@section('subtitle', 'Audit daily employee clock-in records, timeliness, and attendance metrics.')

@section('content')
<div class="grid stats-grid" style="margin-bottom: 1.5rem;">
    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #10b981; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Present Today</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #15803d; margin: 0.35rem 0 0.25rem;">
            {{ $statusSummary['present'] ?? 0 }}
        </strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Clocked-in on schedule</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #ef4444; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Absent</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #b91c1c; margin: 0.35rem 0 0.25rem;">
            {{ $statusSummary['absent'] ?? 0 }}
        </strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">No attendance record logged</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #f59e0b; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Late Check-in</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #b45309; margin: 0.35rem 0 0.25rem;">
            {{ $statusSummary['late'] ?? 0 }}
        </strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Clocked in past grace period</p>
    </div>
</div>

<div class="card" style="padding: 1.5rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #f1f5f9;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
        <h3 style="margin: 0; font-size: 1.15rem; color: #0f172a; font-weight: 700;">Recent Attendance Logs</h3>
        <span class="badge" style="background: #eef2ff; color: #4338ca; font-weight: 600;">
            {{ $records->count() }} Records
        </span>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Staff Member</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $record)
                    <tr>
                        <td>
                            <strong>{{ $record->employee?->first_name }} {{ $record->employee?->last_name }}</strong>
                        </td>
                        <td>{{ $record->date }}</td>
                        <td>
                            <span style="font-family: monospace; color: #334155;">{{ $record->time_in ?? '—' }}</span>
                        </td>
                        <td>
                            <span style="font-family: monospace; color: #334155;">{{ $record->time_out ?? '—' }}</span>
                        </td>
                        <td>
                            @php
                                $statusStyle = match(strtolower($record->status)) {
                                    'present' => 'background: #dcfce7; color: #15803d;',
                                    'late' => 'background: #fef3c7; color: #b45309;',
                                    'absent' => 'background: #fee2e2; color: #b91c1c;',
                                    default => 'background: #f1f5f9; color: #475569;'
                                };
                            @endphp
                            <span class="badge" style="{{ $statusStyle }} font-weight: 700; text-transform: capitalize;">
                                {{ $record->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty" style="padding: 2.5rem; text-align: center; color: #64748b;">
                            ⏱️ No attendance records logged today yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
