<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeWebController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/hr', [DashboardController::class, 'hr'])->name('dashboard.hr');
    Route::get('/dashboard/employee', [DashboardController::class, 'employee'])->name('dashboard.employee');

    Route::resource('employees', EmployeeWebController::class)->except(['show']);

    Route::prefix('hr')->name('hr.')->group(function () {
        Route::get('/attendance', [DashboardController::class, 'attendance'])->name('attendance');
        Route::get('/payroll', [DashboardController::class, 'payroll'])->name('payroll');
        Route::get('/leave-requests', [DashboardController::class, 'leaveRequests'])->name('leave_requests');
        Route::get('/announcements', [DashboardController::class, 'announcements'])->name('announcements');
        Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
    });
});

Route::redirect('/', '/login');
