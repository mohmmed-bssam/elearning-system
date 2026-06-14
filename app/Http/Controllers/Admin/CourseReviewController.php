<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseReview;

class CourseReviewController extends Controller
{
    public function index()
    {
        $reviews = CourseReview::with([
            'user',
            'course'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'admin.course_reviews.index',
            compact('reviews')
        );
    }

    public function destroy(CourseReview $courseReview)
    {
        $courseReview->delete();

        flash()->warning(
            'Review deleted successfully.'
        );

        return redirect()
            ->route('admin.course_reviews.index');
    }
}
