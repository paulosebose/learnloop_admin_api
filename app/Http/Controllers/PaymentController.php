<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PaymentController extends Controller
{
    public function showPaymentPage($subject_id, $user_id)
    {
        $subject = Subject::findOrFail($subject_id);

        return view('payment', [
            'razorpay_key' => config('services.razorpay.key'),
            'amount' => $subject->amount,
            'subject_id' => $subject_id,
            'user_id' => $user_id,
        ]);
    }
    
    
     public function handlePaymentSuccess(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string',
            
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $subject = Subject::findOrFail($request->subject_id);

        Payment::create([
            'subject_id' => $subject->id,
            'amount' => $subject->amount,
            'payment_id' => $request->payment_id,
            'status' => 'success',
            'user_id' => $request->user_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Payment recorded successfully.']);
    }
    
    
    public function listPayments()
{
    $user = Auth::user();

    if ($user->usertype === 'admin') {
        // Admin sees all payments with user and subject data
        $payments = Payment::with(['user', 'subject'])->get();
    } elseif ($user->usertype === 'subadmin') {
      $subjectId = $user->subject_id;

        if (!$subjectId) {
            return view('admin.listpayments', ['payments' => collect()]);
        }

        $payments = Payment::with(['user', 'subject'])
            ->where('subject_id', $subjectId)
            ->get();
    } else {
        abort(403, 'Unauthorized access.');
    }
    return view('admin.listpayments', compact('payments'));
}
    
    
    
}
