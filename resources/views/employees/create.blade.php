@extends('layouts.app')

@section('title', 'Onboard New Employee')
@section('subtitle', 'Fill in the employment details to register a new staff member.')

@section('content')
<div class="card" style="max-width: 860px; margin: 0 auto; padding: 2rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #f1f5f9;">
    <div style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <h3 style="margin: 0; color: #0f172a; font-weight: 700; font-size: 1.25rem;">Employee Information</h3>
            <p style="margin: 0.25rem 0 0; color: #64748b; font-size: 0.9rem;">Fields marked with an asterisk (*) are mandatory.</p>
        </div>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm" style="padding: 0.45rem 0.85rem;">
            ← Back to Directory
        </a>
    </div>

    <form action="{{ route('employees.store') }}" method="post">
        @csrf
        @include('employees._form')
        
        <div class="form-actions" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 0.75rem;">
            <a href="{{ route('employees.index') }}" class="btn btn-secondary" style="padding: 0.75rem 1.25rem;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.75rem; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);">
                Save Employee Record
            </button>
        </div>
    </form>
</div>
@endsection
