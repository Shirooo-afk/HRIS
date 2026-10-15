<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HRIS') — Workforce Management Portal</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    <div class="app-shell">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="brand" style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(255, 255, 255, 0.08); padding-bottom: 1.25rem;">
                <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: inherit;">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); display: grid; place-items: center; color: #fff; font-weight: 800; font-size: 1.1rem; box-shadow: 0 4px 12px rgba(79,70,229,0.3);">
                        H
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 1.1rem; letter-spacing: -0.02em; color: #f8fafc;">HRIS PORTAL</div>
                        <div style="font-size: 0.7rem; color: #94a3b8; font-weight: 500; letter-spacing: 0.04em;">WORKFORCE OS</div>
                    </div>
                </a>
            </div>

            <!-- Current User Badge -->
            @auth
                <div style="margin: 1.25rem 1rem 0.75rem; padding: 0.85rem; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 14px; display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 34px; height: 34px; border-radius: 50%; background: #4f46e5; color: #ffffff; display: grid; place-items: center; font-weight: 700; font-size: 0.85rem;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div style="overflow: hidden; flex: 1;">
                        <div style="color: #f1f5f9; font-weight: 600; font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ auth()->user()->name }}
                        </div>
                        <div style="font-size: 0.7rem; color: #38bdf8; text-transform: uppercase; font-weight: 600; letter-spacing: 0.05em;">
                            ● {{ ucfirst(auth()->user()->role ?? 'user') }}
                        </div>
                    </div>
                </div>
            @endauth

            <nav>
                <div class="menu-heading" style="margin-top: 1rem;">Core</div>
                
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                    <span class="icon">📊</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('employees.index') }}" class="menu-item {{ request()->routeIs('employees.index') ? 'active' : '' }}">
                    <span class="icon">👥</span>
                    <span>Employee Directory</span>
                </a>

                <a href="{{ route('employees.create') }}" class="menu-item {{ request()->routeIs('employees.create') ? 'active' : '' }}">
                    <span class="icon">➕</span>
                    <span>Add Employee</span>
                </a>

                @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'hr']))
                    <div class="menu-heading" style="margin-top: 1.5rem;">Operations</div>

                    <a href="{{ route('hr.attendance') }}" class="menu-item {{ request()->routeIs('hr.attendance') ? 'active' : '' }}">
                        <span class="icon">⏱️</span>
                        <span>Time Attendance</span>
                    </a>

                    <a href="{{ route('hr.leave_requests') }}" class="menu-item {{ request()->routeIs('hr.leave_requests') ? 'active' : '' }}">
                        <span class="icon">🌴</span>
                        <span>Leave Requests</span>
                    </a>

                    <a href="{{ route('hr.payroll') }}" class="menu-item {{ request()->routeIs('hr.payroll') ? 'active' : '' }}">
                        <span class="icon">💰</span>
                        <span>Payroll</span>
                    </a>

                    <a href="{{ route('hr.announcements') }}" class="menu-item {{ request()->routeIs('hr.announcements') ? 'active' : '' }}">
                        <span class="icon">📢</span>
                        <span>Announcements</span>
                    </a>

                    <a href="{{ route('hr.reports') }}" class="menu-item {{ request()->routeIs('hr.reports') ? 'active' : '' }}">
                        <span class="icon">📈</span>
                        <span>Reports</span>
                    </a>
                @endif

                <div class="menu-heading" style="margin-top: 1.5rem;">System</div>

                <a href="{{ route('api.employees.index') }}" target="_blank" rel="noopener" class="menu-item">
                    <span class="icon">🔌</span>
                    <span>REST API Endpoint</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout" style="gap: 0.5rem; font-weight: 600;">
                            <span>Sign Out</span>
                            <span>→</span>
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        <!-- Main Workspace Area -->
        <div class="layout-main">
            <!-- Top Navigation Bar -->
            <header class="topbar">
                <button type="button" class="sidebar-toggle" aria-label="Toggle navigation">
                    ☰
                </button>

                <div class="search" style="box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                    <span style="color: #94a3b8;">🔍</span>
                    <input type="text" id="globalSearchInput" placeholder="Search employees, records, or departments..." onkeyup="filterDirectory(this.value)">
                </div>

                <div style="display: flex; align-items: center; gap: 1rem;">
                    @auth
                        <span class="badge" style="background: #eef2ff; color: #4338ca; font-weight: 600; padding: 0.4rem 0.8rem;">
                            {{ ucfirst(auth()->user()->role) }} Mode
                        </span>
                    @endauth
                    <a href="{{ route('employees.create') }}" class="btn btn-primary" style="padding: 0.65rem 1rem; font-size: 0.85rem;">
                        + New
                    </a>
                </div>
            </header>

            <!-- Page Title Header -->
            <div class="page-header">
                <h1>@yield('title', 'HRIS Portal')</h1>
                @hasSection('subtitle')
                    <p>@yield('subtitle')</p>
                @endif
            </div>

            <!-- Page Content Body -->
            <main class="main-content">
                @if (session('success'))
                    <div class="alert-card alert-success" style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; box-shadow: 0 4px 12px rgba(22, 101, 52, 0.08);">
                        <div style="display: flex; align-items: center; gap: 0.65rem;">
                            <span style="font-size: 1.25rem;">✅</span>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; font-size: 1.25rem; color: #166534; cursor: pointer;">×</button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-card alert-error" style="box-shadow: 0 4px 12px rgba(153, 27, 27, 0.08);">
                        <div style="display: flex; align-items: center; gap: 0.65rem; margin-bottom: 0.5rem; font-weight: 600;">
                            <span style="font-size: 1.25rem;">⚠️</span>
                            <span>Please review the highlighted items:</span>
                        </div>
                        <ul class="list-reset">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
    function filterDirectory(query) {
        const q = query.toLowerCase().trim();
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            if (!q) {
                row.style.display = '';
                return;
            }
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(q) ? '' : 'none';
        });
    }
    </script>
</body>
</html>
