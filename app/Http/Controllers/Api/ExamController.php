<?php

namespace App\Http\Controllers\Api;
use App\Models\Exam;
use App\Models\Level;
use App\Models\UserProgress;
use App\Models\Question; 
use App\Models\UserResponse; 
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
public function examview(Request $request)
{
    $request->validate([
        'level_id' => 'required|exists:levels,id',
    ]);

    $levelId = $request->input('level_id');
    Log::info("Level ID received: {$levelId}");

    $level = Level::findOrFail($levelId);
    Log::info("Fetched Level: ", $level->toArray());

   
    $exams = Exam::where('level_id', $levelId)
    ->where('status', 1) // Exclude status = 0
    ->orderBy('id')
    ->get();
    Log::info("Exams fetched for Level ID {$levelId}: ", $exams->toArray());

    if ($exams->isEmpty()) {
        Log::warning("No exams found for Level ID {$levelId}");
        return response()->json([
            'status' => false,
            'message' => 'No exams found for this level.',
        ], 404);
    }

    $user = $request->user();
    Log::info("User ID: {$user->id}");
      $userProgress = UserProgress::where('user_id', $user->id)
        ->where('level_id', $levelId)
        ->get();

       $accessibleExams = $exams->map(function ($exam, $index) use ($userProgress, $user) {
        $isAccessible = ($index === 0) ? 1 : 0;
$progress = $userProgress->where('exam_id', $exam->id)->first();
Log::info("Progress for Exam ID {$exam->id}: ", $progress ? $progress->toArray() : []);

$isAccessible = ($index === 0) ? 1 : 0;
if ($index > 0 && $progress) {
    $isAccessible = $progress->exam_accessible == 2 ? 1 : $progress->exam_accessible;
}

// Get reappear from user_progress (default to false)
$userReappear = $progress ? (bool)$progress->reappear : false;



        // Fetch latest completion time from user_responses
        $latestCompletionTime = UserResponse::where('exam_id', $exam->id)
            ->where('user_id', $user->id)
            ->latest('completion_time')
            ->value('completion_time');

        Log::info("Latest completion time for Exam ID {$exam->id}: {$latestCompletionTime}");

        // Count Unanswered Questions Excluding Soft-Deleted
        $unansweredQuestionsCount = Question::where('exam_id', $exam->id)
            ->whereNull('deleted_at')
            ->whereNotIn('id', function ($query) use ($exam, $user) {
                $query->select('question_id')
                    ->from('user_responses')
                    ->where('exam_id', $exam->id)
                    ->where('user_id', $user->id);
            })
            ->count();

        // Count Updated Options After User Response Excluding Soft-Deleted
        $updatedOptionsCount = UserResponse::where('exam_id', $exam->id)
            ->where('user_id', $user->id)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('options')
                    ->whereNull('deleted_at')
                    ->whereColumn('options.question_id', 'user_responses.question_id')
                    ->whereColumn('options.updated_at', '>', 'user_responses.updated_at');
            })
            ->count();

        // Final Question Count
        $questionCount = $unansweredQuestionsCount + $updatedOptionsCount;
        Log::info("Final question count for Exam ID {$exam->id}: {$questionCount}");

        // Fetch User Responses with Their Updated At Timestamps
        $userResponses = UserResponse::where('exam_id', $exam->id)
            ->where('user_id', $user->id)
            ->get(['question_id', 'updated_at']);

        Log::info("User responses fetched for Exam ID {$exam->id}: ", $userResponses->toArray());

        // Check If Any Option Has Been Updated After the User's Last Response Excluding Soft-Deleted
        $updateRequired = 0;

        foreach ($userResponses as $response) {
            $latestOptionUpdateTime = DB::table('options')
                ->where('question_id', $response->question_id)
                ->whereNull('deleted_at')
                ->latest('updated_at')
                ->value('updated_at');

            if ($latestOptionUpdateTime && $latestOptionUpdateTime > $response->updated_at) {
                $updateRequired = 1;
                break;
            }
        }

        // Check if a new question was added after the latest completion time
        if ($latestCompletionTime) {
            $newQuestionExists = Question::where('exam_id', $exam->id)
                ->whereNull('deleted_at')
                ->where('created_at', '>', $latestCompletionTime)
                ->exists();

            if ($newQuestionExists) {
                $updateRequired = 1;
            }
        }

        Log::info("Update required for Exam ID {$exam->id}: {$updateRequired}");

        return [
            'id' => $exam->id,
            'exam_name' => $exam->exam_name,
            'image' => $exam->image,
            'is_accessible' => $isAccessible,
            'question_count' => $questionCount,
            'reappear' => $userReappear,
            'update' => $updateRequired,
        ];
    });

    return response()->json([
        'status' => true,
        'level' => [
            'id' => $level->id,
            'level_name' => $level->level_name,
        ],
        'exams' => $accessibleExams,
    ], 200);
}   

    
}
