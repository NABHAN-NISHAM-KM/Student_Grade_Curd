@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Subject</h2>

    <form method="POST" action="{{ route('subjects.store') }}" class="card p-3">
        @csrf
        <div class="row g-2">
            <div class="col-md-10">
                <input type="text" name="subject_name" class="form-control" placeholder="Subject Name" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success w-100">Add</button>
            </div>
        </div>
    </form>
</div>
@endsection
