<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Notifications\NewLessonNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        $courses = Course::with('lessons')
        ->where('teacher_id', $teacher->id)
        ->where('status','active')->get();

        $lessons = Lesson::with('course')
            ->whereHas('course', function ($query) use ($teacher) {
                $query->where('teacher_id', $teacher->id);
            })
            ->latest()
            ->paginate(env('PAGE_SIZE'));

        return view('teacher.lessons.index', compact('lessons', 'courses'));
    }

    public function create(Request $request)
    {
        $courses = Course::where('teacher_id', Auth::id())
            ->latest()
            ->get();
        $courseId = $request->course_id;
        $lesson = new Lesson();

        return view('teacher.lessons.create', compact('courses', 'lesson', 'courseId'));
    }

    public function store(Request $request)
    {
        $teacher = Auth::user();

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'video_url' => 'nullable|url',
            'lesson_order' => 'required|integer|min:1',
        ]);

        $course = Course::where('id', $request->course_id)
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

       $lesson= Lesson::create([
            'course_id' => $course->id,
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'video_url' => $request->video_url,
            'lesson_order' => $request->lesson_order,
        ]);
        $students = $course->students;

        foreach ($students as $student) {
            $student->notify(new NewLessonNotification($course, $lesson));
        }

        flash()->success('Lesson created successfully.');

        return redirect()->route('teacher.lessons.index');
    }

    public function show(Lesson $lesson)
    {

        return view('teacher.lessons.show', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {

        $courses = Course::where('teacher_id', Auth::id())
            ->latest()
            ->get();

        return view('teacher.lessons.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {

        $teacher = Auth::user();

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'video_url' => 'nullable|url',
            'lesson_order' => 'required|integer|min:1',
        ]);

        $course = Course::where('id', $request->course_id)
            ->where('teacher_id', $teacher->id)
            ->firstOrFail();

        $lesson->update([
            'course_id' => $course->id,
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'video_url' => $request->video_url,
            'lesson_order' => $request->lesson_order,
        ]);

        flash()->info('Lesson updated successfully.');

        return redirect()->route('teacher.lessons.index');
    }

    public function destroy(Lesson $lesson)
    {

        $lesson->delete();

        flash()->warning('Lesson deleted successfully.');

        return redirect()->route('teacher.lessons.index');
    }

}