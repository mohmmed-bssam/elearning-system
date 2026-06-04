<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::with('image')->latest()->paginate(env('PAGE_SIZE'));
        return view('admin.sliders.index', compact('sliders'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slider=new Slider();
        return view('admin.sliders.create', compact('slider'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $slider = Slider::create([
            'title' =>[
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'content' => [
                'en' => $request->content_en,
                'ar' => $request->content_ar,
            ],

        ]);
        $path = $request->file('image')->store('uploads/sliders', 'custom');
        Image::create([
            'path' => $path,
            'imageable_id' => $slider->id,
            'imageable_type' => Slider::class,
        ]);
        flash()->success('Slider created successfully');

        return redirect()->route('admin.sliders.index');
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
    public function edit(Slider $slider)
     {
         return view('admin.sliders.edit', compact('slider'));
     }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
        ]);
        $slider->update([
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
            File::delete(public_path($slider->image->path));
            $path = $request->file('image')
                ->store('uploads/sliders', 'custom');
            $slider->image()->update([
                'path' => $path,

            ]);
        }
        flash()->info('Slider updated successfully');

        return redirect()->route('admin.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        File::delete(public_path($slider->image->path));
        $slider->delete();
        flash()->warning('Slider deleted successfully');

        return redirect()->route('admin.sliders.index');
    }
}
