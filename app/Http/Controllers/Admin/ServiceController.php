<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::latest()->paginate(env('PAGE_SIZE'));
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $service=new Service();
        return view('admin.services.create',compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'content_ar' => 'required',
            'content_en' => 'required',
            'icon' => 'required',

        ]);
        Service::create([
            'title' => [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ],
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ],
            'icon' => $request->icon,
        ]);
        flash()->success('Service created successfully.');
        return redirect()->route('admin.services.index');
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
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'content_ar' => 'required',
            'content_en' => 'required',
            'icon' => 'required',

        ]);
        $service->update([
            'title' => [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ],
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ],
            'icon' => $request->icon,
        ]);
        flash()->info('Service updated successfully.');
        return redirect()->route('admin.services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        flash()->warning('Service deleted successfully.');
        return redirect()->route('admin.services.index');
    }
}
