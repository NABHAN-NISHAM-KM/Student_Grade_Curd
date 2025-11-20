@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary-color: #4f46e5;
        --secondary-color: #10b981;
        --danger-color: #ef4444;
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
        margin-bottom: 32px;
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
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 15px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        background: white;
    }

    .form-control::placeholder {
        color: #cbd5e1;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #059669 100%);
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
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
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

    .alert {
        border-radius: 8px;
        border: none;
        padding: 16px 24px;
        margin-bottom: 24px;
        animation: slideDown 0.3s ease;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border-left: 4px solid var(--danger-color);
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

    .form-info {
        background: #f0f4ff;
        border-left: 4px solid var(--primary-color);
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        font-size: 14px;
        color: #4338ca;
    }

    .form-info i {
        margin-right: 8px;
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

        .btn-submit,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container mt-4">
    <div class="page-header">
        <h2>📖 Add New Subject</h2>
        <p>Create a new course subject for your students</p>
    </div>

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle"></i> {{ $error }}
    </div>
    @endforeach
    @endif

    <div class="card-wrapper">
        <div class="form-section">

            <form method="POST" action="{{ route('subjects.store') }}" autocomplete="on">
                @csrf
                <div class="form-group">
                    <label class="form-label">Subject Name <span style="color: var(--danger-color);">*</span></label>
                    <input
                        type="text"
                        name="subject_name"
                        class="form-control @error('subject_name') border-danger @enderror"
                        placeholder="Enter Subject Name"
                        value="{{ old('subject_name') }}"
                        required
                        autofocus
                        autocomplete="name">
                    @error('subject_name')
                    <small style="color: var(--danger-color); margin-top: 6px; display: block;">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-plus-circle"></i> Add Subject
                    </button>
                    <a href="{{ route('subjects.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection