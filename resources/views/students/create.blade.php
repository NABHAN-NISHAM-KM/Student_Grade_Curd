@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Student</h2>

    <form method="POST" action="{{ route('students.store') }}" class="card p-3">
        @csrf
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="student_name" class="form-control" placeholder="Student Name" required>
            </div>
            <div class="col-md-3">
                <select name="subject_key" class="form-control" required>
                    <option value="">Select Subject</option>
                    @foreach($subjects as $s)
                        <option value="{{ $s->subject_key }}">{{ $s->subject_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="grade" class="form-control" placeholder="Grade" required min="0" max="100">
            </div>
            <div class="col-md-1">
                <button class="btn btn-success w-100">Add</button>
            </div>
        </div>
    </form>
</div>
@endsection
