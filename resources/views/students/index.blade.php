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

    .btn-add-student {
        background: white;
        color: var(--primary-color);
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .btn-add-student:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        color: var(--primary-color);
    }

    .card-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .filters-section {
        background: var(--light-bg);
        padding: 24px;
        border-bottom: 1px solid var(--border-color);
    }

    .filter-group {
        display: flex;
        gap: 12px;
        align-items: flex-end;
    }

    .form-control,
    .form-select {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .btn-apply {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-apply:hover {
        background: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .table-wrapper {
        padding: 24px;
    }

    table {
        font-size: 14px;
    }

    table thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        background: var(--light-bg);
        color: #475569;
        font-weight: 700;
        border: none;
        padding: 16px 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 12px;
    }

    table tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    table tbody tr:hover {
        background: var(--light-bg);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    table tbody td {
        padding: 16px 12px;
        vertical-align: middle;
    }

    .student-name {
        font-weight: 600;
        color: #1e293b;
    }

    .subject-text {
        color: #64748b;
    }

    .grade-badge {
        background: #f3f4f6;
        color: var(--primary-color);
        padding: 4px 12px;
        border-radius: 6px;
        font-weight: 700;
        display: inline-block;
    }

    .badge-pass {
        background: #dcfce7;
        color: var(--secondary-color);
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
    }

    .badge-fail {
        background: #fee2e2;
        color: var(--danger-color);
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
    }

    .action-cell {
        text-align: center;
    }

    .btn-delete {
        background: #fee2e2;
        color: var(--danger-color);
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-delete:hover {
        background: var(--danger-color);
        color: white;
        transform: scale(1.05);
    }

    .empty-state {
        text-align: center;
        padding: 48px 24px;
        color: #94a3b8;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }

    .pagination {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        gap: 4px;
    }

    .pagination a,
    .pagination span {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid var(--border-color);
        text-decoration: none;
        color: #64748b;
        transition: all 0.3s ease;
        font-size: 13px;
    }

    .pagination a:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .pagination .active span {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 24px 16px;
        }

        .filter-group {
            flex-direction: column;
        }

        .form-control,
        .form-select,
        .btn-apply {
            width: 100%;
        }

        table {
            font-size: 12px;
        }

        table tbody td {
            padding: 12px 8px;
        }
    }
</style>

<div class="container mt-4">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2>📚 Students List</h2>
            <p>Manage and track student performance</p>
        </div>
        <a href="{{ route('students.create') }}" class="btn btn-add-student">
            <i class="bi bi-plus-circle"></i> Add New Student
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    <div class="card-wrapper">
        <div class="filters-section">
            <form method="GET" class="row g-3">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label fw-600 mb-2">Search Student</label>
                        <input type="text" name="search" class="form-control"
                            placeholder="🔍 Enter student name..."
                            value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label fw-600 mb-2">Filter by Status</label>
                        <select name="filter" class="form-select">
                            <option value="">All</option>
                            <option value="pass" {{ request('filter')=='pass' ? 'selected' : '' }}>
                                ✓ PASS
                            </option>
                            <option value="fail" {{ request('filter')=='fail' ? 'selected' : '' }}>
                                ✗ FAIL
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-apply w-100">
                        <i class="bi bi-funnel"></i> Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <div class="table-wrapper">
            @if($students->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $s)
                        <tr>
                            <td class="student-name">{{ $s->student_name }}</td>
                            <td class="subject-text">{{ $s->subject->subject_name ?? 'N/A' }}</td>
                            <td>
                                <span class="grade-badge">{{ $s->grade }}</span>
                            </td>
                            <td>
                                <span class="badge-{{ strtolower($s->remarks) }}">
                                    {{ $s->remarks }}
                                </span>
                            </td>
                            <td class="action-cell">
                                <form action="{{ route('students.destroy', $s->student_key) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('⚠️ Are you sure? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Delete Student">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $students->links() }}
            </div>
            @else
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h5 class="mt-3">No Students Found</h5>
                <p>Try adjusting your filters or <a href="{{ route('students.create') }}" class="text-primary fw-600">add a new student</a></p>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if(alert) alert.style.display = 'none';
    }, 2000);
</script>

@endsection