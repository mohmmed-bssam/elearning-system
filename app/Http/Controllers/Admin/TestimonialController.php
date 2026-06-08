<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::with('image')->latest()->paginate(env('PAGE_SIZE'));
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $testimonial = new Testimonial();
        return view('admin.testimonials.create', compact('testimonial'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $testimonial= Testimonial::create([
            'name'=>$request->name,
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'content' => [
                'en' => $request->content_en,
                'ar' => $request->content_ar,
            ],

        ]);
        $path = $request->file('image')->store('uploads/testimonials', 'custom');

        Image::create([
            'path'=>$path,
            'imageable_id'=>$testimonial->id,
            'imageable_type'=>Testimonial::class,


        ]);
        flash()->success('Testimonial created successfully');

        return redirect()->route('admin.testimonials.index');
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
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
        ]);
        $testimonial->update([
            'name' => $request->name,
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'content' => [
                'en' => $request->content_en,
                'ar' => $request->content_ar,
            ],

        ]);
        if ($request->hasFile('image')) {
            File::delete(public_path($testimonial->image->path));
            $path = $request->file('image')->store('uploads/testimonials', 'custom');


            $testimonial->image()->update([
                'path' => $path,
               


            ]);
        }
            flash()->info('Testimonial updated successfully');

            return redirect()->route('admin.testimonials.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        File::delete(public_path($testimonial->image->path));
        $testimonial->image()->delete();
        $testimonial->delete();

        flash()->warning('Testimonial deleted successfully');

        return redirect()->route('admin.testimonials.index');
    }
}
