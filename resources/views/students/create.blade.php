@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary-color: #4f46e5;
        --secondary-color: #10b981;
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
        --light-bg: #f8fafc;
        --border-color: #e2e8f0;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
        border-radius: 12px;
        padding: 32px 24px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(79, 70, 229, 0.2);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .page-header h2 {
        color: white;
        font-weight: 700;
        font-size: 28px;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .page-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        margin: 8px 0 0 0;
        position: relative;
        z-index: 2;
    }

    .card-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .form-section {
        padding: 40px;
    }

    .form-group {
        margin-bottom: 28px;
    }

    .form-label {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .form-label i {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
        color: var(--primary-color);
    }

    .form-control, .form-select {
        width: 100%;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 15px;
        transition: all 0.3s ease;
        font-family: inherit;
        background: var(--light-bg);
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        background: white;
    }

    .form-control::placeholder {
        color: #cbd5e1;
    }

    .form-control.is-invalid {
        border-color: var(--danger-color);
        background: #fef2f2;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .alert {
        border-radius: 8px;
        border: none;
        padding: 16px 24px;
        margin-top: 24px;
        animation: slideDown 0.3s ease;
    }

    .alert-warning {
        background: #fef3c7;
        color: #92400e;
        border-left: 4px solid var(--warning-color);
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border-left: 4px solid var(--danger-color);
    }

    .alert i {
        margin-right: 8px;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 36px;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid var(--border-color);
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
        border-color: #cbd5e1;
    }

    .form-info {
        background: #f0f4ff;
        border-left: 4px solid var(--primary-color);
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 32px;
        font-size: 14px;
        color: #4338ca;
    }

    .form-info i {
        margin-right: 8px;
    }

    .error-list {
        margin: 0;
        padding-left: 20px;
    }

    .error-list li {
        margin-bottom: 6px;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 24px 16px;
        }

        .page-header h2 {
            font-size: 24px;
        }

        .form-section {
            padding: 24px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit, .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container mt-4">
    <div class="page-header">
        <h2>👨‍🎓 Add New Student</h2>
        <p>Register a new student and assign their grade</p>
    </div>

    <div style="max-width: 600px; margin: 0 auto;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <strong style="margin-left: 8px;">Please fix the following errors:</strong>
                </div>
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-wrapper">
            <div class="form-section">

                <form method="POST" action="{{ route('students.store') }}" id="studentForm" novalidate>
                    @csrf
                    
                    <div class="form-group">
                        <label for="student_name" class="form-label">
                            <i class="bi bi-person-fill"></i>Student Name
                            <span style="color: var(--danger-color);">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="student_name"
                            name="student_name" 
                            class="form-control @error('student_name') is-invalid @enderror" 
                            placeholder="Enter Student Name"
                            value="{{ old('student_name') }}"
                            required 
                            minlength="3"
                            autofocus
                        >
                        @error('student_name')
                            <small style="color: var(--danger-color); margin-top: 6px; display: block;">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject_key" class="form-label">
                            <i class="bi bi-book-fill"></i>Subject
                            <span style="color: var(--danger-color);">*</span>
                        </label>
                        <select 
                            id="subject_key"
                            name="subject_key" 
                            class="form-select @error('subject_key') is-invalid @enderror"
                            required
                        >
                            <option value="">Select a Subject</option>
                            @foreach($subjects as $s)
                                <option value="{{ $s->subject_key }}" {{ old('subject_key') == $s->subject_key ? 'selected' : '' }}>
                                    {{ $s->subject_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_key')
                            <small style="color: var(--danger-color); margin-top: 6px; display: block;">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="grade" class="form-label">
                            <i class="bi bi-star-fill"></i>Grade (0-100)
                            <span style="color: var(--danger-color);">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="grade"
                            name="grade" 
                            class="form-control @error('grade') is-invalid @enderror"
                            placeholder="Enter grade between 0 and 100" 
                            min="0" 
                            max="100"
                            value="{{ old('grade') }}"
                            required
                        >
                        @error('grade')
                            <small style="color: var(--danger-color); margin-top: 6px; display: block;">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </small>
                        @enderror

                        <div id="grade_below_zero" class="alert alert-warning mt-3 mb-0 d-none">
                            <i class="bi bi-exclamation-circle-fill"></i>Grade cannot be less than 0. Setting to 0.
                        </div>

                        <div id="grade_above_hundred" class="alert alert-warning mt-3 mb-0 d-none">
                            <i class="bi bi-exclamation-circle-fill"></i>Grade cannot be greater than 100. Setting to 100.
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('students.index') }}" class="btn-cancel">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button 
                            type="submit"
                            class="btn-submit"
                        >
                            <i class="bi bi-plus-circle"></i> Add Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('grade').addEventListener('input', function () {
        const val = parseInt(this.value);
        const low = document.getElementById('grade_below_zero');
        const high = document.getElementById('grade_above_hundred');

        low.classList.add('d-none');
        high.classList.add('d-none');

        if (isNaN(val)) return;

        if (val < 0) {
            low.classList.remove('d-none');
            this.value = 0;
        } else if (val > 100) {
            high.classList.remove('d-none');
            this.value = 100;
        }
    });

    document.getElementById('studentForm').addEventListener('submit', function (e) {
        const grade = parseInt(document.getElementById('grade').value);

        if (grade < 0 || grade > 100 || isNaN(grade)) {
            e.preventDefault();
            document.getElementById('grade').classList.add('is-invalid');
        }
    });
</script>

@endsection