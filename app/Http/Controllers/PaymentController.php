<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\NewPaymentRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class PaymentController extends Controller
{
    public function checkout(Course $course)
    {
        $enrolled = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->exists();

        if ($enrolled) {
            flash()->error('You are already enrolled in this course.');

            return redirect()->back();
        } else {
            return view('front.checkout', compact('course'));
        }
    }



    public function store(Course $course)
    {
        $exists = Payment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->where('status', 'pending')
            ->exists();

        if ($exists) {

            flash()->error('Payment request already exists.');

            return back();
        } else {

            Payment::create([
                'user_id' => auth()->id(),
                'course_id' => $course->id,
                'amount' => $course->price,
                'status' => 'pending',
                'payment_gateway' => 'cash',
                'transaction_number' => 'CASH-' . time(),
            ]);
            $admins = User::where('role', 'admin')->get();

            foreach ($admins as $admin) {
                $admin->notify(new NewPaymentRequestNotification());
            }
            flash()->success(
                'Payment request sent successfully. Wait for admin approval.'
            );


            return redirect()->route('student.dashboard');
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
