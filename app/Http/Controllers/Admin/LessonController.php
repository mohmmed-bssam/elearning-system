<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::with('course')->latest()->paginate(env('PAGE_SIZE'));
        return view('admin.lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::latest()->get();
        $lesson = new Lesson();
        return view('admin.lessons.create', compact('courses', 'lesson'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'video_url' => 'nullable|url',
            'lesson_order' => 'required|integer|min:1',
        ]);
        Lesson::create([
            'course_id' => $request->course_id,
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar
            ],
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar
            ],
            'video_url' => $request->video_url,
            'lesson_order' => $request->lesson_order,
        ]);

        flash()->success('Lesson created successfully.');
        return redirect()->route('admin.lessons.index');
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
    public function edit(Lesson $lesson)
    {
        $courses = Course::latest()->get();
        return view('admin.lessons.edit', compact('courses', 'lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'video_url' => 'nullable|url',
            'lesson_order' => 'required|integer|min:1',
        ]);

        $lesson->update([
            'course_id' => $request->course_id,
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar
            ],
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar
            ],
            'video_url' => $request->video_url,
            'lesson_order' => $request->lesson_order,
        ]);

        flash()->info('Lesson updated successfully.');
        return redirect()->route('admin.lessons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        flash()->warning('Lesson deleted successfully.');
        return redirect()->route('admin.lessons.index');
    }
}