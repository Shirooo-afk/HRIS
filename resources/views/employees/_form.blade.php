@php
    $employee = $employee ?? null;
@endphp

<div class="form-group">
    <label for="employee_number">Employee number</label>
    <input type="text" name="employee_number" id="employee_number"
           value="{{ old('employee_number', $employee?->employee_number) }}" required>
    @error('employee_number')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="first_name">First name</label>
    <input type="text" name="first_name" id="first_name"
           value="{{ old('first_name', $employee?->first_name) }}" required>
    @error('first_name')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="last_name">Last name</label>
    <input type="text" name="last_name" id="last_name"
           value="{{ old('last_name', $employee?->last_name) }}" required>
    @error('last_name')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email"
           value="{{ old('email', $employee?->email) }}" required>
    @error('email')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="department">Department</label>
    <input type="text" name="department" id="department"
           value="{{ old('department', $employee?->department) }}" required>
    @error('department')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="job_title">Job title</label>
    <input type="text" name="job_title" id="job_title"
           value="{{ old('job_title', $employee?->job_title) }}" required>
    @error('job_title')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="hire_date">Hire date</label>
    <input type="date" name="hire_date" id="hire_date"
           value="{{ old('hire_date', $employee?->hire_date?->format('Y-m-d')) }}" required>
    @error('hire_date')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" required>
        @foreach ($statuses as $status)
            <option value="{{ $status->value }}"
                @selected(old('status', $employee?->status?->value ?? 'active') === $status->value)>
                {{ str_replace('_', ' ', ucfirst($status->value)) }}
            </option>
        @endforeach
    </select>
    @error('status')<div class="error">{{ $message }}</div>@enderror
</div>
