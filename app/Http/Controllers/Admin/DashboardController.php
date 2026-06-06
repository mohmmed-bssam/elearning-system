<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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

    public function settings()
    {
        return view('admin.settings');
    }

    public function settings_update(Request $request,Setting $setting)
    {
        $data = $request->except(['_token', '_method', 'site_logo']);
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
        flash()->success('Settings updated successfully');

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
