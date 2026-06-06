<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with('course', 'user')->latest()->paginate(env('PAGE_SIZE'));
        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();

        return view('admin.enrollments.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:pending,active,completed',
        ]);

        $exists = Enrollment::where('user_id', $request->user_id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Student already enrolled in this course.');
        }

        Enrollment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'status' => $request->status,
            'enrolled_at' => now(),
        ]);
        flash()->success('Enrollment created successfully.');

        return redirect()->route('admin.enrollments.index');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();

        return view(
            'admin.enrollments.edit',
            compact('enrollment', 'students', 'courses')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:pending,active,completed',
        ]);

        $enrollment->update([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'status' => $request->status,
        ]);
        flash()->info('Enrollment updated successfully.');
        return redirect()->route('admin.enrollments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        flash()->warning('Enrollment deleted successfully.');
        return redirect()->route('admin.enrollments.index');
    }
}
