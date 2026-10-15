<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentStatus;
use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        $role = $request->user()->role;

        return redirect()->route(match ($role) {
            'admin' => 'dashboard.admin',
            'hr' => 'dashboard.hr',
            default => 'dashboard.employee',
        });
    }

    public function admin(): View
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', EmploymentStatus::Active)->count();
        $terminatedEmployees = Employee::where('status', EmploymentStatus::Terminated)->count();

        return view('dashboard.admin', compact('totalEmployees', 'activeEmployees', 'terminatedEmployees'));
    }

    public function hr(): View
    {
        abort_unless(auth()->user()->role === 'hr', 403);

        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', EmploymentStatus::Active)->count();
        $pendingLeaves = LeaveRequest::where('status', 'pending')->count();

        return view('dashboard.hr', compact('totalEmployees', 'activeEmployees', 'pendingLeaves'));
    }

    public function attendance(): View
    {
        abort_unless(auth()->user()->role === 'hr', 403);

        $statusSummary = Attendance::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $records = Attendance::with('employee')
            ->orderByDesc('date')
            ->orderByDesc('time_in')
            ->limit(12)
            ->get();

        return view('hr.attendance', compact('statusSummary', 'records'));
    }

    public function payroll(): View
    {
        abort_unless(auth()->user()->role === 'hr', 403);

        $payrollCount = Payroll::count();
        $totalPayout = Payroll::sum('net_salary');
        $recentPayrolls = Payroll::with('employee')
            ->orderByDesc('pay_date')
            ->limit(10)
            ->get();

        return view('hr.payroll', compact('payrollCount', 'totalPayout', 'recentPayrolls'));
    }

    public function leaveRequests(): View
    {
        abort_unless(auth()->user()->role === 'hr', 403);

        $pendingLeaves = LeaveRequest::where('status', 'pending')->with('employee')->get();
        $leaveSummary = LeaveRequest::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('hr.leave_requests', compact('pendingLeaves', 'leaveSummary'));
    }

    public function announcements(): View
    {
        abort_unless(auth()->user()->role === 'hr', 403);

        $announcements = Announcement::latest()->limit(12)->get();

        return view('hr.announcements', compact('announcements'));
    }

    public function reports(): View
    {
        abort_unless(auth()->user()->role === 'hr', 403);

        $totalEmployees = Employee::count();
        $approvedLeaves = LeaveRequest::where('status', 'approved')->count();
        $pendingLeaves = LeaveRequest::where('status', 'pending')->count();
        $payrollCount = Payroll::count();

        return view('hr.reports', compact('totalEmployees', 'approvedLeaves', 'pendingLeaves', 'payrollCount'));
    }

    public function employee(): View
    {
        return view('dashboard.employee');
    }
}
