@php
    $employee = $employee ?? null;
@endphp

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem;">
    <div class="form-group">
        <label for="employee_number">Employee Number *</label>
        <input type="text" name="employee_number" id="employee_number"
               value="{{ old('employee_number', $employee?->employee_number) }}"
               placeholder="e.g. EMP-001" required
               style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem;">
        @error('employee_number')<div class="error" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem;">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="first_name">First Name *</label>
        <input type="text" name="first_name" id="first_name"
               value="{{ old('first_name', $employee?->first_name) }}"
               placeholder="e.g. Jane" required
               style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem;">
        @error('first_name')<div class="error" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem;">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="last_name">Last Name *</label>
        <input type="text" name="last_name" id="last_name"
               value="{{ old('last_name', $employee?->last_name) }}"
               placeholder="e.g. Doe" required
               style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem;">
        @error('last_name')<div class="error" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem;">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="email">Work Email Address *</label>
        <input type="email" name="email" id="email"
               value="{{ old('email', $employee?->email) }}"
               placeholder="jane.doe@company.com" required
               style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem;">
        @error('email')<div class="error" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem;">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="department">Department *</label>
        <input type="text" name="department" id="department"
               value="{{ old('department', $employee?->department) }}"
               placeholder="e.g. Engineering, Sales, HR" required
               style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem;">
        @error('department')<div class="error" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem;">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="job_title">Job Title *</label>
        <input type="text" name="job_title" id="job_title"
               value="{{ old('job_title', $employee?->job_title) }}"
               placeholder="e.g. Senior Software Developer" required
               style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem;">
        @error('job_title')<div class="error" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem;">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="hire_date">Hire Date *</label>
        <input type="date" name="hire_date" id="hire_date"
               value="{{ old('hire_date', $employee?->hire_date?->format('Y-m-d')) }}" required
               style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem;">
        @error('hire_date')<div class="error" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem;">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="status">Employment Status *</label>
        <select name="status" id="status" required
                style="border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0.75rem 1rem; background-color: #fff;">
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}"
                    @selected(old('status', $employee?->status?->value ?? 'active') === $status->value)>
                    {{ str_replace('_', ' ', ucfirst($status->value)) }}
                </option>
            @endforeach
        </select>
        @error('status')<div class="error" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem;">{{ $message }}</div>@enderror
    </div>
</div>
