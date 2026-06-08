<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseReview;
use App\Models\User;
use Illuminate\Http\Request;

class CourseReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = CourseReview::with(['user', 'course'])
            ->latest()
            ->paginate(10);

        return view('admin.course_reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();
        $courseReview =new CourseReview();

        return view(
            'admin.course_reviews.create',
            compact('students', 'courses', 'courseReview')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'rate' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $exists = CourseReview::where('user_id', $request->user_id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            flash()->error('This student already reviewed this course.');
            return back()->withInput();

                // ->with('error', 'This student already reviewed this course.');
        }

        CourseReview::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
        ]);
        flash()->success('Review created successfully.');
        return redirect()->route('admin.course_reviews.index');
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
    public function edit(CourseReview $courseReview)
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();

        return view(
            'admin.course_reviews.edit',
            compact('courseReview', 'students', 'courses')
        );
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseReview $courseReview)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'rate' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $courseReview->update([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
        ]);
        flash()->info('Review updated successfully.');

        return redirect()
            ->route('admin.course_reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseReview $courseReview)
    {
        $courseReview->delete();

        flash()->warning('Review deleted successfully.');

        return redirect()
            ->route('admin.course_reviews.index');
    }
}
