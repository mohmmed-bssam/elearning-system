<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('image')->latest()->paginate(env('PAGE_SIZE'));

        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        $team = new Team();
        return view('admin.teams.create', compact('team'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $team=Team::create([
            'name'=>$request->name,
            'job_title'=>$request->job_title,
            'fb'=>$request->facebook,
            'x'=>$request->x,
            'insta'=>$request->instagram,
        ]);

        $path = $request->file('image')->store('uploads/teams', 'custom');
        Image::create([
            'path' => $path,
            'imageable_id' => $team->id,
            'imageable_type' => Team::class,
        ]);

        flash()->success('teams created successfully');

        return redirect()->route('admin.teams.index');
    }



    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        $team->update([
            'name' => $request->name,
            'job_title' => $request->job_title,
            'fb' => $request->facebook,
            'x' => $request->x,
            'insta' => $request->instagram,
        ]);
        if ($request->hasFile('image')) {
            // Delete old image
            File::delete(public_path('uploads/' . $team->image->path));
            // Store new image
            $path = $request->file('image')->store('uploads/teams', 'custom');
            $team->image()->update([
                'path' => $path,

            ]);
        }
        flash()->info('teams updated successfully');

        return redirect()->route('admin.teams.index');
    }

    public function destroy(Team $team)
    {
        File::delete(public_path('uploads/' . $team->image->path));
        $team->image()->delete();
        $team->delete();

        flash()->warning('teams deleted successfully');

        return redirect()->route('admin.teams.index');
    }
}
