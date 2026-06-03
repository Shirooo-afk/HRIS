@extends('layouts.app')

@section('title', 'Edit employee')

@section('content')
    <h2 class="page-title">Edit {{ $employee->first_name }} {{ $employee->last_name }}</h2>

    <div class="card" style="padding: 1.5rem;">
        <form action="{{ route('employees.update', $employee) }}" method="post">
            @csrf
            @method('PUT')
            @include('employees._form', ['employee' => $employee])
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update employee</button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
