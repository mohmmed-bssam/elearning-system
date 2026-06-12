<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Auth::user();

        $coursesCount = Course::where('teacher_id', $teacher->id)->count();

        $lessonsCount = Lesson::whereHas('course', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->count();

        $studentsCount = Enrollment::whereHas('course', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->count();

        return view('teacher.dashboard', compact(
            'coursesCount',
            'lessonsCount',
            'studentsCount'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function courses()
    {
        $teacher=Auth::user();
        $courses = Course::with('image', 'teacher','category')
            ->where('teacher_id', $teacher->id)->latest()
            ->paginate(env('PAGE_SIZE'));

        return view('teacher.courses', compact('courses'));
    }
    public function students(){
        $teacher = Auth::user();
        $students = User::whereHas('enrollments.course', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->distinct()->get();
        return view('teacher.students', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}