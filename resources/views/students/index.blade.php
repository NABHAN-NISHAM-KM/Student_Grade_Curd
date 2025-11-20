@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Students</h2>

    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add New Student</a>

    <!-- Search + Filter -->
    <form method="GET" class="mb-3 d-flex gap-2">
        <input type="text" name="search" class="form-control"
            placeholder="Search student name..." value="{{ request('search') }}">
        <select name="filter" class="form-control">
            <option value="">All</option>
            <option value="pass" {{ request('filter')=='pass' ? 'selected' : '' }}>PASS</option>
            <option value="fail" {{ request('filter')=='fail' ? 'selected' : '' }}>FAIL</option>
        </select>
        <button class="btn btn-primary">Filter</button>
    </form>

    <!-- Students Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Subject</th>
                <th>Grade</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($students as $s)
            <tr>
                <td>{{ $s->student_name }}</td>
                <td>{{ $s->subject->subject_name ?? 'N/A' }}</td>
                <td>{{ $s->grade }}</td>
                <td>
                    <span class="badge {{ $s->remarks == 'PASS' ? 'bg-success' : 'bg-danger' }}">
                        {{ $s->remarks }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('students.destroy', $s->student_key) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $students->links() }}
</div>
@endsection