<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Classes;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('class')->latest()->get();
        return inertia('students/Index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classes::all();
        return inertia('students/Create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        Student::create($data);
        return redirect()->route('students')->with('message', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = Classes::all();
        return inertia('students/Edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        $student->update($data);
        return redirect()->route('students')->with('message', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students')->with('message', 'Student deleted successfully.');
    }
}
