<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\PaymentApprovedNotification;
use App\Notifications\StudentEnrolledNotification;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index()
    {
        $payments = Payment::with(['student', 'course'])
            ->latest()
            ->paginate(env('PAGE_SIZE'));
        return view('admin.payments.index', compact('payments'));
    }
    public function approvePayment($id)
    {
        $payment = Payment::findOrFail($id);

        if ($payment->status == 'paid') {
            flash()->error('Payment already approved.');
            return back();
        }

        // 1. تغيير الحالة
        $payment->update([
            'status' => 'paid'
        ]);

        // 2. إنشاء Enrollment إذا مش موجود
        $exists = Enrollment::where('user_id', $payment->user_id)
            ->where('course_id', $payment->course_id)
            ->exists();

        if (!$exists) {
            Enrollment::create([
                'user_id' => $payment->user_id,
                'course_id' => $payment->course_id,
                'status'=>'active',
                'enrolled_at'=>now(),
            ]);
            $course = $payment->course;

            $student = User::where('id', $payment->user_id )->first();

            $student->notify(new PaymentApprovedNotification($course));
            flash()->success(
                'request approval successfully.'
            );
            // للطالب


            // للمعلم
             $course->teacher->notify(new StudentEnrolledNotification($student, $course));
        }

        flash()->success('Payment approved and student enrolled successfully.');

        return back();
    }
    public function rejectPayment($id)
    {
        $payment = Payment::findOrFail($id);

        if ($payment->status != 'pending') {
            flash()->error('This payment is already processed.');
            return back();
        }

        $payment->update([
            'status' => 'Failed'
        ]);

        flash()->warning('Payment rejected successfully.');

        return back();
    }



    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->update([
        'status'=>$request->status,
        ]);
        flash()->info('status updated successfully.');
        return redirect()->route('admin.payments.index');
    }


    public function destroy(Payment $payment)
    {
        $payment->delete();
        flash()->warning('payment updated successfully.');
        return redirect()->route('admin.payments.index');
    }
}