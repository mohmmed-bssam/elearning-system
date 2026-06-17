<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{

    public function dashboard()
    {

    return view('admin.dashboard');
    }
    public function subscriptions()
    {
        $subscriptions = Subscription::latest()->paginate(env('PAGE_SIZE'));
        return view('admin.subscriptions', compact('subscriptions'));
    }
    public function delete_subscriptions($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();
        flash()->warning('Subscription deleted successfully.');
        return redirect()->route('admin.subscriptions');
    }
    public function notifications()
    {
        $notifications = Auth::user()->notifications;

        return view('admin.notifications', compact('notifications'));
    }
    public function markAsRead(DatabaseNotification $notification)
    {
        $notification->update(['read_at' => now()]);
        return redirect()->back();
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function settings_update(Request $request)
    {
        $data = $request->except([
            '_token',
            '_method',
            'site_logo',
            'about_logo',
            'gallery'
        ]);
        if ($request->hasFile('site_logo')) {
            $data['site_logo'] =  $request->file('site_logo')
                ->store('uploads/settings', 'custom');
        }
        if ($request->hasFile('about_logo')) {
            $data['about_logo'] =  $request->file('about_logo')
                ->store('uploads/settings', 'custom');
        }


        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        if ($request->hasFile('gallery')) {

            foreach ($request->gallery as $img) {

                $path = $img->store('uploads/gallery', 'custom');

                Gallery::Create([
                    'image' => $path,
                ]);
            }
        }
        flash()->success('Settings updated successfully');

        return redirect()->back();
    }
    function delete_gallery(Gallery $gallery)
    {
        File::delete(public_path($gallery->image));
        $gallery->delete();
        return redirect()->back();
    }
    public function messages()
    {
        $messages = Message::latest()->paginate(env('PAGE_SIZE'));
        return view('admin.messages', compact('messages'));
    }
    public function delete_messages($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        flash()->warning('Message deleted successfully.');
        return redirect()->route('admin.messages');
    }
}