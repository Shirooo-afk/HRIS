<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentStatus;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        return redirect()->route(
            $request->user()->role === 'admin' ? 'dashboard.admin' : 'dashboard.employee'
        );
    }

    public function admin(): View
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', EmploymentStatus::Active)->count();
        $terminatedEmployees = Employee::where('status', EmploymentStatus::Terminated)->count();

        return view('dashboard.admin', compact('totalEmployees', 'activeEmployees', 'terminatedEmployees'));
    }

    public function employee(): View
    {
        return view('dashboard.employee');
    }
}
