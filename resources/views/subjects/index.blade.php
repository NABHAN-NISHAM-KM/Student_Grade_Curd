@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subjects</h2>

    <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Add New Subject</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subject Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->subject_name }}</td>
                <td>
                    <form action="{{ route('subjects.destroy', $subject->subject_key) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $subjects->links() }}
</div>
@endsection
