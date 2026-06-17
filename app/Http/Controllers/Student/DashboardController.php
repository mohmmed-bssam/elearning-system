<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CourseReview;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     */
    public function index()
    {
        $student = Auth::user();

        $coursesCount = Enrollment::where('user_id', $student->id)->count();

        $completedCourses = Enrollment::where('user_id', $student->id)
            ->where('status', 'completed')
            ->count();

        $reviewsCount = CourseReview::where('user_id', $student->id)->count();

        $enrollments = Enrollment::with('course')
            ->where('user_id', $student->id)
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'coursesCount',
            'completedCourses',
            'reviewsCount',
            'enrollments'
        ));
    }

    /**
     * عرض الكورسات مع الليسونز الخاصة بالطالب
     */
    public function lessons()
    {
        $courses = auth()->user()
            ->enrolledCourses()
            ->with(['teacher', 'lessons'])
            ->wherePivot('status', 'active')
            ->get();

        return view('student.lessons', compact('courses'));
    }
    public function notifications()
    {
        $notifications = Auth::user()->notifications;

        return view('student.notifications', compact('notifications'));
    }
    public function markAsRead(DatabaseNotification $notification)
    {
        $notification->update(['read_at' => now()]);
        return redirect()->back();
    }
}