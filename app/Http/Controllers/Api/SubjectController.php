<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubjectController extends Controller
{
  public function getSubjects(Request $request)
{
    $userId = auth()->id();
    $status = $request->status; // 0 = all subjects, 1 = purchased subjects

    $data = [];

    // If status = 1 → Fetch purchased courses
    if ($status == 1) {
        $payments = \DB::table('payments')
            ->where('user_id', $userId)
            ->where('status', 'success')
            ->get();

        foreach ($payments as $payment) {
            $subject = \DB::table('subjects')
                ->where('id', $payment->subject_id)
                ->whereNull('deleted_at')
                ->first();

            if (!$subject) {
                continue;
            }

            // Extract duration days
            preg_match('/\d+/', $subject->duration ?? '0', $matches);
            $durationDays = isset($matches[0]) ? (int)$matches[0] : 0;

            if ($durationDays > 0) {
                $paymentDate = \Carbon\Carbon::parse($payment->created_at);
                $expiryDate = $paymentDate->copy()->addDays($durationDays);
                $today = \Carbon\Carbon::now();

                if ($today->lessThanOrEqualTo($expiryDate)) {
                    // Still valid → include
                    $data[] = [
                        'subject_id' => $subject->id,
                        'subject_name' => $subject->subject_name,
                        'amount' => $subject->amount,
                        'image' => $subject->image,
                        'validity' => $today->diffInDays($expiryDate) . ' days',
                        'paid_on' => $payment->created_at,
                    ];
                }
            }
        }

        return response()->json([
            'status' => true,
            'type' => 'purchased',
            'data' => $data,
        ], 200);
    }

    // Else → status = 0 (fetch all subjects)
    $subjectData = Subject::withoutTrashed()->get();

    foreach ($subjectData as $subject) {
        $validity = "0 days";

        $payment = \DB::table('payments')
            ->where('user_id', $userId)
            ->where('subject_id', $subject->id)
            ->orderBy('created_at', 'desc')
            ->first();


            $isPaid = false;
$isExpired = false;

if ($payment) {
    $isPaid = true;
}

// Access table
if (!$isPaid) {
    $isPaid = DB::table('subject_accesses')
        ->where('user_id', $userId)
        ->where('subject_id', $subject->id)
        ->where('accessibility', 1)
        ->exists();
}

// Duration logic
if (!is_null($subject->duration)) {
    $durationDays = (int)$subject->duration;

    if ($payment) {
        $paymentDate = Carbon::parse($payment->created_at);
        $expiryDate  = $paymentDate->copy()->addDays($durationDays);
        $today       = Carbon::now();

        if ($today->lessThanOrEqualTo($expiryDate)) {
            $validity = $today->diffInDays($expiryDate) . ' days';
        } else {
            $validity = "0 days";
            $isExpired = true; // ✅ separate flag
        }
    } else {
        $validity = $durationDays . ' days';
    }
}

        // $isPaid = $payment ? true : false;

        // // If not paid, check access table
        // if (!$isPaid) {
        //     $access = \DB::table('subject_accesses')
        //         ->where('user_id', $userId)
        //         ->where('subject_id', $subject->id)
        //         ->where('accessibility', 1)
        //         ->exists();
        //     $isPaid = $access;
        // }

        // // Duration and validity check
        // if (!is_null($subject->duration)) {
        //     $durationDays = (int)$subject->duration;

        //     if ($payment) {
        //         $paymentDate = Carbon::parse($payment->created_at);
        //         $expiryDate = $paymentDate->copy()->addDays($durationDays);
        //         $today = Carbon::now();

        //         if ($today->lessThanOrEqualTo($expiryDate)) {
        //             $remainingDays = (int)$today->diffInDays($expiryDate);
        //             $validity = $remainingDays . ' days';
        //         } else {
        //             $validity = "0 days";
        //             $isPaid = false;
        //         }
        //     } else {
        //         $validity = $durationDays . ' days';
        //     }
        // }

        // Subadmin info
        $subadmin = \DB::table('users')
            ->where('subject_id', $subject->id)
            ->where('usertype', 'subadmin')
            ->select('name', 'mobile')
            ->first();

        // Count levels, exams, and questions
        $levelIds = \DB::table('levels')
            ->where('subject_id', $subject->id)
            ->whereNull('deleted_at')
            ->pluck('id')
            ->toArray();

        $examIds = \DB::table('exams')
            ->whereIn('level_id', $levelIds)
            ->whereNull('deleted_at')
            ->pluck('id')
            ->toArray();

        $totalExams = count($examIds);
        $totalQuestions = \DB::table('questions')
            ->whereIn('exam_id', $examIds)
            ->whereNull('deleted_at')
            ->count();

        $data[] = [
            'id' => $subject->id,
            'admin_id' => $subject->admin_id,
            'subject_name' => $subject->subject_name,
            'amount' => $subject->amount,
            'image' => $subject->image,
            'subadmin' => $subadmin?->name ?? null,
            'phone' => $subadmin?->mobile ?? null,
            'validity' => $validity,
            'paid' => $isPaid ? 1 : 0,
            'expired'  => $isExpired ? 1 : 0,
            'total_exams' => $totalExams,
            'total_questions' => $totalQuestions,
        ];
    }

    return response()->json([
        'status' => true,
        'type' => 'all_subjects',
        'data' => $data,
    ], 200);
}




public function purchasedCourses()
{
    $userId = auth()->id(); // get authenticated user

    // Get all successful payments of this user
    $payments = \DB::table('payments')
        ->where('user_id', $userId)
        ->where('status', 'success')
        ->get();

    $data = [];

    foreach ($payments as $payment) {
        $subject = \DB::table('subjects')
            ->where('id', $payment->subject_id)
            ->whereNull('deleted_at') // exclude trashed subjects
            ->first();

        if (!$subject) {
            continue; // skip if subject not found
        }

        // Extract number of days from duration string (e.g., "30 days")
        preg_match('/\d+/', $subject->duration ?? '0', $matches);
        $durationDays = isset($matches[0]) ? (int)$matches[0] : 0;

        if ($durationDays > 0) {
            $paymentDate = \Carbon\Carbon::parse($payment->created_at);
            $expiryDate = $paymentDate->copy()->addDays($durationDays);
            $today = \Carbon\Carbon::now();

            if ($today->lessThanOrEqualTo($expiryDate)) {
                // Valid subject, include in response
                $data[] = [
                    'subject_id' => $subject->id,
                    'subject_name' => $subject->subject_name,
                    'amount' => $subject->amount,
                    'image' => $subject->image,
                    'validity' => $today->diffInDays($expiryDate) . ' days',
                    'paid_on' => $payment->created_at,
                ];
            }
        }
    }

    return response()->json([
        'status' => true,
        'data' => $data,
    ], 200);
}


}
