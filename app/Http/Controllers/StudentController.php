<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('subject');

        if ($request->search) {
            $query->where('student_name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filter === 'pass') {
            $query->where('remarks', 'PASS');
        } elseif ($request->filter === 'fail') {
            $query->where('remarks', 'FAIL');
        }

        $students = $query->paginate(10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('subject_name')->get();
        return view('students.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name'  => 'required',
            'subject_key'   => 'required|exists:mst_subjects,subject_key',
            'grade'         => 'required|integer|min:0|max:100',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Student deleted successfully.');
    }
}
