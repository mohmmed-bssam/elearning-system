<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
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
        // Logic to retrieve current settings
    }

    public function settings_update(Request $request)
    {
        // Logic to validate and update settings
        // For example:
        // $request->validate([
        //     'site_name' => 'required|string|max:255',
        //     'contact_email' => 'required|email',
        // ]);

        // Update settings in the database or configuration

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