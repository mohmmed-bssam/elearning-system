<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses=Course::with('category','image','teacher')->latest()->paginate(env('PAGE_SIZE'));
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $teachers=User::where('role','teacher')->get();
        $course=new Course();
        return view('admin.courses.create', compact('categories', 'teachers', 'course'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'title_en'=>'required|string',
            'title_ar'=>'required|string',
            'slug'=>'nullable|string|unique:courses,slug',
            'description_en'=>'required|string',
            'description_ar'=>'required|string',
            'price'=>'required|numeric',
            'hours'=>'required|numeric',
            'teacher_id'=>'required|exists:users,id',
            'category_id'=>'required|exists:categories,id',
            'status'=>'required|in:active,inactive',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $course = Course::create([
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'slug' => $request->slug,
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'price' => $request->price,
            'hours' => $request->hours,
            'teacher_id' => $request->teacher_id,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);
        $path = $request->file('image')->store('uploads/courses', 'custom');
        Image::create([
            'path' => $path,
            'imageable_id' => $course->id,
            'imageable_type' => Course::class,
        ]);
        flash()->success('Course created successfully');
        return redirect()->route('admin.courses.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
     {
         $categories=Category::all();
         $teachers=User::where('role','teacher')->get();
         return view('admin.courses.edit', compact('categories', 'teachers', 'course'));
     }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
     {
         $request->validate([
             'title_en'=>'required|string',
             'title_ar'=>'required|string',
             'slug'=>'nullable|string|unique:courses,slug,' . $course->id,
             'description_en'=>'required|string',
             'description_ar'=>'required|string',
             'price'=>'required|numeric',
             'hours'=>'required|numeric',
             'teacher_id'=>'required|exists:users,id',
             'category_id'=>'required|exists:categories,id',
             'status'=>'required|in:active,inactive',
         ]);
         $course->update([
             'title' => [
                 'en' => $request->title_en,
                 'ar' => $request->title_ar,
             ],
             'slug' => $request->slug,
             'description' => [
                 'en' => $request->description_en,
                 'ar' => $request->description_ar,
             ],
             'price' => $request->price,
             'hours' => $request->hours,
             'teacher_id' => $request->teacher_id,
             'category_id' => $request->category_id,
             'status' => $request->status,
         ]);
         if ($request->hasFile('image')) {
             // Delete old image
                File::delete(public_path('uploads/' . $course->image->path));
             // Store new image
             $path = $request->file('image')->store('uploads/courses', 'custom');
             Image::update([
                 'path' => $path,
                 'imageable_id' => $course->id,
                 'imageable_type' => Course::class,
             ]);
         }
         flash()->info('Course updated successfully');
         return redirect()->route('admin.courses.index');
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // Delete associated image

            File::delete(public_path('uploads/' . $course->image->path));
            $course->image()->delete();

        $course->delete();
        flash()->warning('Course deleted successfully');
        return redirect()->route('admin.courses.index');
    }
}
