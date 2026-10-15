@extends('layouts.app')

@section('title', 'Payroll Records')
@section('subtitle', 'Salary distributions, payout cycles, and employee net remuneration.')

@section('content')
<div class="grid stats-grid" style="margin-bottom: 1.5rem;">
    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #4f46e5; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Processed Slips</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #0f172a; margin: 0.35rem 0 0.25rem;">
            {{ $payrollCount }}
        </strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Historical payment batches</p>
    </div>

    <div class="card" style="padding: 1.5rem; border-radius: 20px; border-top: 4px solid #10b981; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);">
        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Total Payout Volume</span>
        <strong style="display: block; font-size: 2.25rem; font-weight: 800; color: #15803d; margin: 0.35rem 0 0.25rem;">
            ${{ number_format($totalPayout, 2) }}
        </strong>
        <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Total net distribution</p>
    </div>
</div>

<div class="card" style="padding: 1.5rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #f1f5f9;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
        <h3 style="margin: 0; font-size: 1.15rem; color: #0f172a; font-weight: 700;">Recent Disbursement Records</h3>
        <span class="badge" style="background: #eef2ff; color: #4338ca; font-weight: 600;">
            {{ $recentPayrolls->count() }} Payments
        </span>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Beneficiary</th>
                    <th>Pay Date</th>
                    <th>Bonuses</th>
                    <th>Deductions</th>
                    <th style="text-align: right;">Net Salary</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentPayrolls as $payroll)
                    <tr>
                        <td>
                            <strong>{{ $payroll->employee?->first_name }} {{ $payroll->employee?->last_name }}</strong>
                        </td>
                        <td>{{ $payroll->pay_date }}</td>
                        <td>
                            <span style="color: #15803d; font-weight: 600;">+${{ number_format($payroll->bonuses, 2) }}</span>
                        </td>
                        <td>
                            <span style="color: #b91c1c; font-weight: 600;">-${{ number_format($payroll->deductions, 2) }}</span>
                        </td>
                        <td style="text-align: right;">
                            <strong style="font-size: 1.05rem; color: #0f172a;">${{ number_format($payroll->net_salary, 2) }}</strong>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty" style="padding: 2.5rem; text-align: center; color: #64748b;">
                            💰 No payroll disbursements recorded in the system.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
