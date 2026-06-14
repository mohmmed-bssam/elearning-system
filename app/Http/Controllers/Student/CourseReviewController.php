<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseReviewController extends Controller
{
    /**
     * Store a newly created review.
     */
    public function index()
    {
        $reviews = CourseReview::with('course')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('student.reviews.index', compact('reviews'));
    }
    public function create(Course $course)
    {
        $review = CourseReview::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();

        if ($review) {
            flash()->error('لقد قمت بتقييم هذا الكورس مسبقاً');

            return redirect()->route('student.reviews.index');
        }

        return view('student.reviews.create', compact('course'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'rate' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $reviewExists = CourseReview::where('user_id', Auth::id())
            ->where('course_id', $request->course_id)
            ->exists();

        if ($reviewExists) {
            flash()->error('لقد قمت بتقييم هذا الكورس مسبقاً');
            return redirect()->route('student.lessons');
        } else {



            CourseReview::create([
                'user_id' => Auth::id(),
                'course_id' => $request->course_id,
                'rate' => $request->rate,
                'comment' => $request->comment,
            ]);
            flash()->success('Rating add successful');

            return redirect()->route('student.lessons');
        }
    }
}
