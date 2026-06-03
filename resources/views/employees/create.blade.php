@extends('layouts.app')

@section('title', 'Add employee')

@section('content')
    <h2 class="page-title">Add employee</h2>

    <div class="card" style="padding: 1.5rem;">
        <form action="{{ route('employees.store') }}" method="post">
            @csrf
            @include('employees._form')
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save employee</button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
