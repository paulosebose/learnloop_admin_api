<?php

namespace App\Http\Controllers\Api;
use App\Models\Level;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\UserProgress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 
use App\Models\Question;
use App\Models\Option;
use Carbon\Carbon;

use App\Models\UserResponse;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LevelController extends Controller
{
public function getLevel(Request $request)
{
    $user = $request->user(); 

    $request->validate([
        'subject_id' => 'required',
    ]);

    $subjectId = $request->input('subject_id'); 
    Log::info("Requested Subject ID: {$subjectId}");

    $levels = Level::where('subject_id', $subjectId)->get();
    if ($levels->isEmpty()) {
        return response()->json([
            'status' => false,
            'message' => 'No levels found for the selected subject.',
        ], 404); 
    }
    
     $validity = "0 days";
     
      $isPaid   = false;

    $subject = Subject::find($subjectId);
    if ($subject) {
        $payment = DB::table('payments')
            ->where('user_id', $user->id)
            ->where('subject_id', $subject->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $isPaid = $payment ? true : false;

        if (!$isPaid) {
            $access = DB::table('subject_accesses')
                ->where('user_id', $user->id)
                ->where('subject_id', $subject->id)
                ->where('accessibility', 1)
                ->exists();
            $isPaid = $access;
        }

        if (!is_null($subject->duration)) {
            $durationDays = (int) $subject->duration;

            if ($payment) {
                $paymentDate = Carbon::parse($payment->created_at);
                $expiryDate  = $paymentDate->copy()->addDays($durationDays);
                $today       = Carbon::now();

                if ($today->lessThanOrEqualTo($expiryDate)) {
                    $remainingDays = (int) $today->diffInDays($expiryDate);
                    $validity = $remainingDays . ' days';
                } else {
                    $validity = "0 days";
                    $isPaid   = false;
                }
            } else {
                // not paid → just show total duration
                $validity = $durationDays . ' days';
            }
        }
    }

    $userLevelProgress = UserProgress::where('user_id', $user->id)
        ->pluck('is_accessible', 'level_id')
        ->toArray();

    $allMessages = [];

    $levelData = $levels->map(function ($level) use ($userLevelProgress, $user, &$allMessages) {
        $exams = DB::table('exams')
    ->where('level_id', $level->id)
    ->whereNull('deleted_at')
    ->get();

        $messages = [];

        foreach ($exams as $exam) {
            Log::info("Processing Exam ID: {$exam->id}");

            $userResponse = UserResponse::where('user_id', $user->id)
                ->where('exam_id', $exam->id)
                ->orderBy('completion_time', 'desc')
                ->first();

            $examUpdateExists = false;

            if ($userResponse) {
                Log::info("Latest Completion Time for Exam ID {$exam->id}: {$userResponse->completion_time}");

                $newQuestionExists = DB::table('questions')
                    ->where('exam_id', $exam->id)
                    ->where('created_at', '>', $userResponse->completion_time)
                    ->exists();

                $updatedOptionExists = DB::table('questions')
                    ->join('options', 'questions.id', '=', 'options.question_id')
                    ->where('questions.exam_id', $exam->id)
                    ->where('options.updated_at', '>', $userResponse->completion_time)
                    ->exists();

                if ($newQuestionExists || $updatedOptionExists) {
                    $examUpdateExists = true;
                }
            }

            if ($examUpdateExists) {
                $messages[] = "Updated questions in '{$exam->exam_name}' at '{$level->level_name}'.";
            }
        }

        $allMessages = array_merge($allMessages, $messages);

        $paidValue = $level->paid;
        if ($level->paid == 1) {
            $accessibility = DB::table('level_accesses')
                ->where('user_id', $user->id)
                ->where('level_id', $level->id)
                ->value('accessibility');
            $paidValue = ($accessibility == 1) ? 1 : 0;
        } elseif ($level->paid == 2) {
            $paidValue = 1;
        }

        return [
            'id' => $level->id,
            'name' => $level->level_name,
            'image' => $level->image,
            'paid' => 1,
            'exam_count' => $exams->count(),
            'messages' => $messages,
            'exams' => $exams->map(function ($exam) {
                return [
                    'id' => $exam->id,
                    
                    'name' => $exam->exam_name,
                    'exam_image' => $exam->image,
                    'level_id' => $exam->level_id,
                    'is_accessible' => $exam->is_accessible ?? 0,
                ];
            }),
        ];
    });

    return response()->json([
        'status' => true,
        // 'messages' => array_unique($allMessages), 
        'duration' => $validity,
        'data' => $levelData,
    ], 200);
}


}
