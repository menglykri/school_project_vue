<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::latest()->get();
        return inertia('classes/Index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('classes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'room_number' => 'required|string|max:255',
        ]);

        Classes::create($data);
        return redirect()->route('classes')->with('message', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classItem = Classes::findOrFail($id);
        return inertia('classes/Edit', compact('classItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $classItem = Classes::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'room_number' => 'required|string|max:255',
        ]);

        $classItem->update($data);
        return redirect()->route('classes')->with('message', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classItem = Classes::findOrFail($id);
        $classItem->delete();
        return redirect()->route('classes')->with('message', 'Class deleted successfully.');
    }
}
