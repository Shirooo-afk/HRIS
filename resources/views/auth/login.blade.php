@extends('layouts.guest')

@section('title', 'Sign In')

@section('content')
<div class="login-container">
    <div class="login-shell">
        <!-- Left Hero Showcase Panel -->
        <aside class="login-panel">
            <div class="login-panel-copy">
                <span class="badge" style="background: rgba(79, 70, 229, 0.1); color: #4338ca; font-weight: 600; padding: 0.4rem 0.9rem; border-radius: 9999px;">
                    ✨ Next-Gen HRIS
                </span>
                <h2 style="font-size: 2.3rem; font-weight: 800; line-height: 1.15; margin: 1.25rem 0 1rem; color: #0f172a;">
                    Empowering People & Workforce Operations
                </h2>
                <p style="color: #64748b; font-size: 1.05rem; line-height: 1.6; margin-bottom: 2rem;">
                    Everything your organization needs in one unified workspace: employee profiles, attendance tracking, leave requests, and payroll reporting.
                </p>

                <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1.5rem;">
                    <div style="display: flex; align-items: flex-start; gap: 0.85rem; background: #ffffff; padding: 0.9rem 1.1rem; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);">
                        <div style="width: 36px; height: 36px; border-radius: 10px; background: #e0e7ff; color: #4338ca; display: grid; place-items: center; font-size: 1.1rem; flex-shrink: 0;">
                            👥
                        </div>
                        <div>
                            <strong style="color: #1e293b; font-size: 0.95rem; display: block;">Centralized Directory</strong>
                            <span style="color: #64748b; font-size: 0.85rem;">Manage employee records, departments, and active statuses seamlessly.</span>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 0.85rem; background: #ffffff; padding: 0.9rem 1.1rem; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);">
                        <div style="width: 36px; height: 36px; border-radius: 10px; background: #dcfce7; color: #15803d; display: grid; place-items: center; font-size: 1.1rem; flex-shrink: 0;">
                            ⚡
                        </div>
                        <div>
                            <strong style="color: #1e293b; font-size: 0.95rem; display: block;">Fast Role-Based Portals</strong>
                            <span style="color: #64748b; font-size: 0.85rem;">Dedicated workflows for Administrators, HR staff, and team members.</span>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 0.85rem; background: #ffffff; padding: 0.9rem 1.1rem; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);">
                        <div style="width: 36px; height: 36px; border-radius: 10px; background: #fef3c7; color: #b45309; display: grid; place-items: center; font-size: 1.1rem; flex-shrink: 0;">
                            📊
                        </div>
                        <div>
                            <strong style="color: #1e293b; font-size: 0.95rem; display: block;">Attendance & Payroll Insight</strong>
                            <span style="color: #64748b; font-size: 0.85rem;">Accurate attendance logs, salary distributions, and instant reports.</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Right Login Form Panel -->
        <section class="login-form-card card" style="box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.12); border: 1px solid #f1f5f9;">
            <div class="login-header" style="margin-bottom: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; border-radius: 14px; background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); display: grid; place-items: center; color: #ffffff; font-weight: 800; font-size: 1.25rem; box-shadow: 0 8px 16px rgba(79, 70, 229, 0.25);">
                        H
                    </div>
                    <div>
                        <h2 style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #0f172a;">Sign In to HRIS</h2>
                        <p class="section-copy" style="margin: 0.15rem 0 0; color: #64748b; font-size: 0.9rem;">Enter your credentials to continue</p>
                    </div>
                </div>
            </div>

            @if (session('status'))
                <div class="alert-card alert-success" style="margin-bottom: 1.25rem;">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert-card alert-error" style="margin-bottom: 1.25rem;">
                    <ul class="list-reset">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" style="font-size: 0.875rem; font-weight: 600; color: #334155;">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                           placeholder="name@company.com"
                           style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem; font-size: 0.95rem; transition: border-color 0.2s, box-shadow 0.2s;">
                </div>

                <div class="form-group">
                    <label for="password" style="font-size: 0.875rem; font-weight: 600; color: #334155;">Password</label>
                    <input id="password" name="password" type="password" required
                           placeholder="••••••••"
                           style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem; font-size: 0.95rem; transition: border-color 0.2s, box-shadow 0.2s;">
                </div>

                <div class="form-row" style="margin: 0.75rem 0 1.25rem;">
                    <div class="form-checkbox">
                        <input id="remember" name="remember" type="checkbox" class="checkbox-input" style="accent-color: #4f46e5; width: 16px; height: 16px; cursor: pointer;">
                        <label for="remember" class="checkbox-label" style="font-size: 0.875rem; color: #475569; cursor: pointer;">Remember this device</label>
                    </div>
                </div>

                <div class="form-actions" style="margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary btn-block" style="padding: 0.85rem; font-size: 1rem; font-weight: 600; border-radius: 12px; background: #4f46e5; box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);">
                        Sign In →
                    </button>
                </div>
            </form>

            <!-- Quick Demo Credentials Selector -->
            <div style="margin-top: 1.75rem; padding-top: 1.5rem; border-top: 1px dashed #cbd5e1;">
                <p style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; margin: 0 0 0.75rem;">
                    ⚡ Quick Demo Autofill (One-Click Sign-in):
                </p>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;">
                    <button type="button" onclick="fillLogin('admin@hris.test', 'password')"
                            style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 10px; padding: 0.6rem 0.4rem; font-size: 0.8rem; font-weight: 600; color: #1e293b; cursor: pointer; text-align: center; transition: all 0.2s;">
                        👑 Admin
                    </button>
                    <button type="button" onclick="fillLogin('hr@hris.test', 'password')"
                            style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 10px; padding: 0.6rem 0.4rem; font-size: 0.8rem; font-weight: 600; color: #1e293b; cursor: pointer; text-align: center; transition: all 0.2s;">
                        👥 HR Staff
                    </button>
                    <button type="button" onclick="fillLogin('employee@hris.test', 'password')"
                            style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 10px; padding: 0.6rem 0.4rem; font-size: 0.8rem; font-weight: 600; color: #1e293b; cursor: pointer; text-align: center; transition: all 0.2s;">
                        💼 Employee
                    </button>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
function fillLogin(email, password) {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    if (emailInput && passwordInput) {
        emailInput.value = email;
        passwordInput.value = password;
        emailInput.style.borderColor = '#4f46e5';
        passwordInput.style.borderColor = '#4f46e5';
        setTimeout(() => {
            emailInput.style.borderColor = '#cbd5e1';
            passwordInput.style.borderColor = '#cbd5e1';
        }, 1200);
    }
}
</script>
@endsection
