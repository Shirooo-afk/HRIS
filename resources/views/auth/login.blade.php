@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <div class="card" style="padding: 2rem; max-width: 480px; margin: 0 auto;">
        <h2 class="page-title">Log in to HRIS</h2>

        <p style="margin-bottom: 1.5rem; color: #475569;">Enter your email and password to access the employee dashboard.</p>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 0.75rem;">
                <input id="remember" name="remember" type="checkbox" style="width: auto; margin: 0;">
                <label for="remember" style="margin: 0; font-size: 0.95rem;">Remember me</label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Log in</button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
