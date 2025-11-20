<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('subject_name')->paginate(10);
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|unique:mst_subjects,subject_name',
        ]);

        Subject::create([
            'subject_name' => $request->subject_name
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function destroy(Subject $subject)
    {
        // Optional: prevent deletion if students exist
        if ($subject->students()->count() > 0) {
            return back()->with('error', 'Cannot delete subject with assigned students.');
        }

        $subject->delete();
        return back()->with('success', 'Subject deleted successfully.');
    }
}
