<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseReview;
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
        $teacher = Auth::user();
        $courses = Course::with('image', 'teacher', 'category')
            ->where('teacher_id', $teacher->id)->latest()
            ->paginate(env('PAGE_SIZE'));

        return view('teacher.courses', compact('courses'));
    }
    public function students()
    {
        $teacher = Auth::user();

        $students = User::whereHas('enrollments.course', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->with(['enrollments.course'])
            ->distinct()
            ->get();

        return view('teacher.students', compact('students'));
    }

    public function reviews()
    {
        $reviews = CourseReview::with(['user', 'course'])
            ->whereHas('course', function ($query) {
                $query->where('teacher_id', auth()->id());
            })
            ->latest()
            ->paginate(10);
        $averageRate = CourseReview::whereHas('course', function ($query) {
            $query->where('teacher_id', auth()->id());
        })->avg('rate');

        return view('teacher.reviews', compact('reviews','averageRate'));
    }

}
