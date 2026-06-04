<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('image')->latest()->paginate(env('PAGE_SIZE'));
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('admin.categories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $category = Category::create([
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'slug' => $request->slug,
        ]);
        $path = $request->file('image')->store('uploads/categories', 'custom');
        Image::create([
            'path' => $path,
            'imageable_id' => $category->id,
            'imageable_type' => Category::class,
        ]);
        flash()->success('Category created successfully');
        return redirect()->route('admin.categories.index');
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
        ]);
        $category->update([
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'slug' => $request->slug,
        ]);
        if ($request->hasFile('image')) {
            File::delete(public_path('uploads/' . $category->image->path));
            $path = $request->file('image')->store('uploads/categories', 'custom');


            Image::update([
                'path' => $path,
                'imageable_id' => $category->id,
                'imageable_type' => Category::class,
            ]);
        }
        flash()->info('Category updated successfully');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        File::delete(public_path($category->image->path));

        $category->image()->delete();
        $category->delete();
        flash()->warning('Category deleted successfully');
        return redirect()->route('admin.categories.index');
    }
}