<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'HRIS') — Human Resource Information System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background: #f4f6f9;
            color: #1a2332;
            line-height: 1.5;
        }
        a { color: #2563eb; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .header {
            background: #1e3a5f;
            color: #fff;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        .header h1 { margin: 0; font-size: 1.25rem; font-weight: 600; }
        .header h1 a { color: inherit; text-decoration: none; }
        .header nav a {
            color: #cbd5e1;
            margin-left: 1.25rem;
            font-size: 0.9rem;
        }
        .header nav a:hover { color: #fff; }
        .container { max-width: 1100px; margin: 0 auto; padding: 1.5rem; }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            line-height: 1.4;
        }
        .btn-primary { background: #2563eb; color: #fff; }
        .btn-primary:hover { background: #1d4ed8; text-decoration: none; }
        .btn-secondary { background: #e2e8f0; color: #334155; }
        .btn-secondary:hover { background: #cbd5e1; text-decoration: none; }
        .btn-danger { background: #dc2626; color: #fff; }
        .btn-danger:hover { background: #b91c1c; text-decoration: none; }
        .btn-sm { padding: 0.35rem 0.65rem; font-size: 0.8rem; }
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        th, td { padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #f8fafc; font-weight: 600; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.03em; }
        tr:last-child td { border-bottom: none; }
        .badge {
            display: inline-block;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .badge-active { background: #dcfce7; color: #166534; }
        .badge-on_leave { background: #fef3c7; color: #92400e; }
        .badge-terminated { background: #fee2e2; color: #991b1b; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-weight: 500; margin-bottom: 0.35rem; font-size: 0.875rem; }
        .form-group input, .form-group select {
            width: 100%;
            max-width: 400px;
            padding: 0.5rem 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font: inherit;
        }
        .form-group .error { color: #dc2626; font-size: 0.8rem; margin-top: 0.25rem; }
        .form-actions { margin-top: 1.5rem; display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .page-title { margin: 0 0 1rem; font-size: 1.5rem; font-weight: 600; }
        .actions { display: flex; gap: 0.35rem; flex-wrap: wrap; }
        .empty { padding: 2rem; text-align: center; color: #64748b; }
    </style>
</head>
<body>
    <header class="header">
        <h1><a href="{{ route('employees.index') }}">HRIS</a></h1>
        <nav>
            <a href="{{ route('employees.index') }}">Employees</a>

            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('employees.create') }}">Add employee</a>
                <a href="{{ route('api.employees.index') }}" target="_blank" rel="noopener">API</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-secondary" style="border:none; display:inline; vertical-align:middle;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </header>

    <main class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
