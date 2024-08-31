<?php

namespace App\Http\Controllers;

use App\Models\OfferedCourses;
use Illuminate\Http\Request;

class OfferedCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offerdcourses = OfferedCourses::all();
        return view('OfferedCourses.index', compact('offerdcourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('OfferedCourses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        OfferedCourses::create([
            'name' => $request->name,
        ]);
        return redirect('/offered_courses');
    }


    public function show(OfferedCourses $offeredCourses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $offered_courses = OfferedCourses::findOrFail($id);
        return view('OfferedCourses.edit', compact('offered_courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name = $request->name;
        $check = OfferedCourses::find($id);

        $check->name = $name;
        $check->save();
        return  redirect('/offered_courses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offered_courses = OfferedCourses::findOrFail($id);
        $offered_courses->delete();
        return back()->with('error', 'Blogs deleted successfully.');
    }
}
