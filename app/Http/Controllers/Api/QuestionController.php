<?php

namespace App\Http\Controllers\Api;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Option;
use App\Models\Level;
use App\Models\UserProgress;
use App\Models\UserResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;






class QuestionController extends Controller
{
    public function showQuestions($examId)
    {
        $exam = Exam::findOrFail($examId); 
        $questions = Question::where('exam_id', $examId)->get(); 
    
        return response()->json([
            'exam' => $exam,
            'questions' => $questions
        ], 200);
    }
    
    
    
    public function addNotSureOption()
{
   
    $questionIds = \App\Models\Question::pluck('id');

    foreach ($questionIds as $questionId) {
        
        $exists = \App\Models\Option::where('question_id', $questionId)
            ->where('option', 'Not Sure')
            ->exists();

        if (!$exists) {
            // Insert "Not Sure" option
            \App\Models\Option::create([
                'question_id' => $questionId,
                'option' => 'Not Sure',
                'is_correct' => 0, // since it's not a correct answer
            ]);
        }
    }

    return response()->json([
        'message' => '"Not Sure" option added for all questions successfully.'
    ], 200);
}


   

   


public function submitAnswer(Request $request)
{
     \Log::info('submitAnswer API called.', ['request_data' => $request->all()]);
    $request->validate([
        'exam_id' => 'required|exists:exams,id', // Validate exam ID
        'question_id' => 'required|exists:questions,id',
        'answer' => 'required|exists:options,id', // Ensure answer is a valid option ID
    ]);

    $examId = $request->exam_id; // Get exam ID from request
    $question = Question::findOrFail($request->question_id);
    $selectedOption = Option::where('question_id', $question->id)
        ->where('id', $request->answer)
        ->first();

    if (!$selectedOption) {
        return response()->json([
            'status' => false,
            'error' => 'Invalid answer provided.'], 400);
    }

    $isCorrect = $selectedOption->is_correct;
    $user = $request->user();

   $userResponse = UserResponse::firstOrNew(
    [
        'user_id' => $user->id,
        'exam_id' => $examId,
        'question_id' => $question->id,
    ]
);
\Log::info('Setting selected_option_id.');
$userResponse->selected_option_id = $selectedOption->id;

\Log::info('Setting is_correct.');
$userResponse->is_correct = $isCorrect ? 1 : 0;

\Log::info('Setting incorrect_count.');
$userResponse->incorrect_count = !$isCorrect ? ($userResponse->incorrect_count + 1) : $userResponse->incorrect_count;

\Log::info('Setting correct_count.');
$userResponse->correct_count = $isCorrect ? ($userResponse->correct_count + 1) : $userResponse->correct_count;
// if ($isCorrect && $userResponse->status == 'troubled') {
//     $userResponse->remaining_repeats = 0; 
// }

\Log::info('Updating remaining_repeats.');
if (!$isCorrect) {
    if ($userResponse->status === 'mastered') 
    {
        $userResponse->status = 'troubled';
    } 
    elseif ($userResponse->status !== 'troubled') 
    {
        // Only update remaining_repeats and status if it's NOT already troubled
       $userResponse->remaining_repeats = $userResponse->remaining_repeats + 1;


        if ($userResponse->incorrect_count >= 3) {
            $userResponse->status = 'troubled';
        } else {
            $userResponse->status = 'pending';
        }
    }
}


else {
    if ($userResponse->remaining_repeats > 0 && $userResponse->remaining_repeats < 3) {
        $userResponse->remaining_repeats = max(0, $userResponse->remaining_repeats - 1);
    }

    if ($userResponse->remaining_repeats == 0) {
        $userResponse->status = 'mastered';
    } else {
        $userResponse->status = 'pending';
    }
}

// Save the changes
$userResponse->save();




 if ($userResponse->incorrect_count >= 3) {
    \Log::info("User meets condition to unlock next exam.", [
        'remaining_repeats' => $userResponse->remaining_repeats,
        'incorrect_count' => $userResponse->incorrect_count,
        'exam_id' => $examId,
        'user_id' => $user->id,
    ]);

        $currentExam = Exam::findOrFail($examId);

      $nextExam = Exam::where('level_id', $currentExam->level_id)
    ->where('status', 1)
    ->whereNull('deleted_at')
    ->where('id', '>', $currentExam->id)
    ->orderBy('id', 'asc')
    ->first();


       if ($nextExam) {
    $progress = UserProgress::updateOrCreate(
        [
            'user_id' => $user->id,
            'exam_id' => $nextExam->id,
        ],
        [
            'exam_accessible' => 2,
            'level_id' => $nextExam->level_id,
            'is_accessible' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );

    \Log::info("✅ Next exam unlocked or updated", [
        'next_exam_id' => $nextExam->id,
        'was_recently_created' => $progress->wasRecentlyCreated,
    ]);
}

    }
    // 🟩 END OF NEW CODE



try {
    $userResponse->save();
    \Log::info('UserResponse saved successfully.');
} catch (\Exception $e) {
    \Log::error('Error while saving userResponse:', ['error' => $e->getMessage()]);
}



    // Fetch the updated response
    $userResponse = UserResponse::where('user_id', $user->id)
        ->where('exam_id', $examId)
        ->where('question_id', $question->id)
        ->first();

    \Log::info('Before Decrement - Incorrect Count: ' . $userResponse->incorrect_count);
    \Log::info('Before Decrement - Correct Count: ' . $userResponse->correct_count);

   if ($isCorrect) {
    // Do nothing or add correct logic if needed
} else {
    // Ensure correct_count doesn't go below 0
    if ($userResponse && $userResponse->correct_count > 0) {
        $userResponse->correct_count = max(0, $userResponse->correct_count - 1);
        $userResponse->save(); // Save the updated value
    }
}

    // Update user progress
    UserProgress::updateOrCreate(
        [
            'user_id' => $user->id,
            'exam_id' => $examId,
        ],
        [
            'level_id' => Exam::findOrFail($examId)->level_id,
            'correct_count' => $isCorrect ? \DB::raw('correct_count + 1') : \DB::raw('correct_count'),
            'incorrect_count' => $isCorrect ? \DB::raw('incorrect_count') : \DB::raw('incorrect_count + 1'),
        ]
    );
    
   
    $totalQuestions = Question::where('exam_id', $examId)
    ->whereNull('deleted_at')
    ->count();

    $answeredQuestionsCount = UserResponse::where('user_id', $user->id)
        ->where('exam_id', $examId)
        ->count();
        \Log::info("Total Questions: $totalQuestions, Answered Questions Count: $answeredQuestionsCount");

   

   // Always update completion_time for the last answered question
$latestUserResponse = UserResponse::where('user_id', $user->id)
    ->where('exam_id', $examId)
    ->orderBy('id', 'desc')
    ->first();

if ($latestUserResponse) {
    $latestUserResponse->completion_time = now();
    $latestUserResponse->save();
}

    $correctAnswers = UserResponse::where('user_id', $user->id)
        ->where('exam_id', $examId)
        ->where('is_correct', true)
        ->count();
        Log::info('Correct answers count for user_id: ' . $user->id . ', exam_id: ' . $examId . ' is ' . $correctAnswers);

    // Update is_accessible if all questions have been answered correctly
    if ($totalQuestions === $correctAnswers) {
        // Update the current exam to accessible
        UserProgress::where('user_id', $user->id)
            ->where('exam_id', $examId)
            ->update(['exam_accessible' => 1]);

        // Find the current exam to determine its order
        $currentExam = Exam::findOrFail($examId);
        
        // Retrieve the next exam based on the current exam's level_id
        $nextExam = Exam::where('level_id', $currentExam->level_id)
            ->where('id', '>', $currentExam->id)
            ->orderBy('id')
            ->first();
            \Log::info("Next exam identified:", ['next_exam_id' => optional($nextExam)->id]);


        // If a next exam is found, update its accessibility in UserProgress
        if ($nextExam) {
            UserProgress::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'exam_id' => $nextExam->id,
                ],
                [
                    'exam_accessible' => 2, // Mark the next exam as accessible
                    'level_id' => $nextExam->level_id,
                ]
            );
        }

        // Check if all exams in the current level are completed
        $completedExamsCount = UserProgress::where('user_id', $user->id)
            ->where('level_id', $currentExam->level_id)
            ->where('exam_accessible', 1) // Assuming 1 means the exam is completed
            ->count();

        $totalExamsInCurrentLevel = Exam::where('level_id', $currentExam->level_id)->count();
        
        
        \Log::info("Completed Exams: $completedExamsCount / Total Exams: $totalExamsInCurrentLevel");


        // If all exams in the current level are completed, enable the next level
        if ($completedExamsCount === $totalExamsInCurrentLevel) {
            $nextLevel = Level::where('id', '>', $currentExam->level_id)
                ->orderBy('id')
                ->first();
                if (!$nextLevel) {
    \Log::warning("No next level found after level ID: {$currentExam->level_id}");
}

        
            if ($nextLevel) {
                // Retrieve the first exam of the next level
                $firstExamInNextLevel = Exam::where('level_id', $nextLevel->id)
                    ->orderBy('id')
                    ->first();
        
                if ($firstExamInNextLevel) {
                    // Update or create user progress for the next level's first exam
                    UserProgress::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'level_id' => $nextLevel->id,
                            'exam_id' => $firstExamInNextLevel->id, // Set the exam ID to the first exam in the next level
                        ],
                        [
                            'is_accessible' => 1, // Enable access for the first exam of the next level
                        ]
                    );
                }
            }
        }
    }
     $correctOption = Option::where('question_id', $question->id)
        ->where('is_correct', 1)
        ->first();

    return response()->json([
        'status'=>true,
        'answer_status' => $isCorrect ? 1 : 0,
        'correct_answer' => !$isCorrect && $correctOption ? 'The correct answer is: ' . $correctOption->option : null,
        'message' => $isCorrect ? 'Correct answer!' : 'Incorrect answer, please try again.',
    ]);
} 



















public function getQuestionsWithOptions(Request $request)
{
    $request->validate([
        'exam_id' => 'required',
    ]);

    $examId = $request->input('exam_id');
    $userId = $request->user()->id;

    $totalQuestions = Question::where('exam_id', $examId)->whereNull('deleted_at')->count();

    if ($totalQuestions === 0) {
        \Log::warning("No questions found for this exam", ['exam_id' => $examId]);
        return response()->json([
            'status' => false,
            'message' => 'No questions found for this exam.',
        ], 404);
    }

    $userResponses = UserResponse::where('user_id', $userId)
        ->where('exam_id', $examId)
        ->get()
        ->keyBy('question_id');

    $questions = Question::where('exam_id', $examId)
        ->whereNull('deleted_at')
        ->select('id', 'exam_id', 'question', 'image','image_position', 'reason', 'created_at', 'updated_at')
        ->get();

    $allOptions = Option::whereIn('question_id', $questions->pluck('id'))
        ->select('id', 'question_id', 'option', 'is_correct', 'updated_at')
        ->get()
        ->groupBy('question_id');

    $finalQuestions = [];
    $remainingRepeatsTotal = 0;
    $questionIndex = 1; 

    foreach ($questions as $question) {
        $response = $userResponses->get($question->id);
        $includeQuestion = false;
        $logMessage = "Question ID: {$question->id} - ";
      // ✅ Exclude if status is 'troubled' or 'mastered' (regardless of correctness)
if ($response && in_array($response->status, ['troubled', 'mastered'])) {
    \Log::info("Excluding question due to status '{$response->status}'", [
        'question_id' => $question->id,
        'user_id' => $userId,
    ]);
    continue; // skip this question entirely
}

        $options = $allOptions[$question->id] ?? collect();
        $latestOptionUpdatedAt = $options->max('updated_at');

        \Log::info("Processing Question", [
            'question_id' => $question->id,
            'exam_id' => $examId,
            'options_count' => count($options),
            'has_response' => $response ? true : false
        ]);

        if (!$response) {
            $includeQuestion = true;
            $logMessage .= "New question (Unanswered).";
        } else {
            $isCorrect = $response->is_correct ?? 0;
            $incorrectCount = $response->incorrect_count ?? 0;
            $remainingRepeats = $response->remaining_repeats ?? 0;
            $completionTime = $response->completion_time ?? null;
            $responseUpdatedAt = $response->updated_at ?? null;

            $remainingRepeatsTotal += $remainingRepeats;

            \Log::info("User Response Details", [
                'question_id' => $question->id,
                'is_correct' => $isCorrect,
                'incorrect_count' => $incorrectCount,
                'remaining_repeats' => $remainingRepeats,
                'completion_time' => $completionTime,
                'response_updated_at' => $responseUpdatedAt,
                'question_updated_at' => $question->updated_at
            ]);

            // Reset incorrect_count and remaining_repeats if the options were updated
            if ($responseUpdatedAt && $latestOptionUpdatedAt && $responseUpdatedAt < $latestOptionUpdatedAt && $incorrectCount >= 3) {
                \Log::info("Resetting incorrect_count and remaining_repeats for question", [
                    'question_id' => $question->id,
                    'user_id' => $userId
                ]);
                $response->update([
                    'incorrect_count' => 0,
                    'remaining_repeats' => 0
                ]);
            }

            // if ($incorrectCount >= 3) {
            //     \Log::info("Skipping question due to 3 incorrect attempts", ['question_id' => $question->id]);
            //     continue;
            // }

            if ($responseUpdatedAt && $responseUpdatedAt < $question->updated_at) {
                $includeQuestion = true;
                $logMessage .= "UPDATED (Question text changed). ";
            }

            foreach ($options as $option) {
                if ($responseUpdatedAt && $responseUpdatedAt < $option->updated_at) {
                    $includeQuestion = true;
                    $logMessage .= "UPDATED (Options changed). ";
                    break;
                }
            }

            if ($completionTime && $completionTime < $question->created_at) {
                $includeQuestion = true;
                $logMessage .= "UPDATED (New question added after completion). ";
            }

            if (!($isCorrect >= 1 && $remainingRepeats == 0)) {
                $includeQuestion = true;
                $logMessage .= "UPDATED (Incorrect or has repeats left). ";
            }
        }

       if ($includeQuestion) {
           
            $notSureOption = $options->firstWhere('option', 'Not Sure');

$otherOptions = $options->filter(function ($option) {
    return $option->option !== 'Not Sure';
})->shuffle()->values();

if ($notSureOption) {
    $otherOptions->push($notSureOption);
}

$shuffledOptions = $otherOptions->values(); 
    $question->options = $shuffledOptions;
   

    $repeatCount = 1;  // Include the question at least once by default

    // Include remaining_repeats only if incorrect_count is less than 3
//   if ($response && isset($incorrectCount) && $incorrectCount < 3 && isset($remainingRepeats) && $remainingRepeats > 0) {
//     $repeatCount = $remainingRepeats;
// }


if ($response && isset($remainingRepeats) && $remainingRepeats > 0) {
    $repeatCount = $remainingRepeats;
}



    for ($i = 0; $i < $repeatCount; $i++) {
        $finalQuestions[] = $question;
    }

    if (strpos($logMessage, "UPDATED") !== false) {
        \Log::info("UPDATED QUESTION DETECTED: " . $logMessage, ['question_id' => $question->id]);
    } else {
        \Log::info($logMessage);
    }
} else {
    \Log::info("Skipping question", ['question_id' => $question->id]);
}

    }

    $newTotalQuestions = $totalQuestions + $remainingRepeatsTotal;

    $userProgress = UserProgress::where('user_id', $userId)
        ->where('exam_id', $examId)
        ->first();

    if ($userProgress && $userProgress->total_questions < $newTotalQuestions) {
        \Log::info("Updating total_questions in user_progress", ['user_id' => $userId, 'exam_id' => $examId, 'new_total_questions' => $newTotalQuestions]);
        $userProgress->update(['total_questions' => $newTotalQuestions]);
    }

   $uniqueRemainingQuestionCount = collect($finalQuestions)
    ->pluck('id')
    ->unique()
    ->count();

    \Log::info("Final response prepared", [
        'user_id' => $userId,
        'exam_id' => $examId,
        'total_questions' => $userProgress->total_questions ?? $totalQuestions,
        'remaining_questions' => $uniqueRemainingQuestionCount,
    ]);

    return response()->json([
        'status' => true,
        'total_questions' => $totalQuestions,
        'remaining_questions' => $uniqueRemainingQuestionCount,
        'questions' => $finalQuestions,
    ]);
}


public function updateLevelAccessibility(Request $request, $userId)
{
    // Get the user
    $user = User::find($userId);

    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Get submitted accessible levels
    $accessibleLevels = $request->input('accessible_levels', []); // Default to an empty array if none selected

    // Update is_accessible for the given user
    $levels = Level::all();
    foreach ($levels as $level) {
        $userProgress = UserProgress::where('user_id', $userId)
            ->where('level_id', $level->id)
            ->first();

        if ($userProgress) {
            $userProgress->is_accessible = in_array($level->id, $accessibleLevels) ? 1 : $userProgress->is_accessible;
            $userProgress->save();
        }
    }

    return redirect()->back()->with('success', 'Level accessibility updated successfully.');
}


public function troubledQuestions(Request $request)
{
    // Validate the level_id parameter
    $request->validate([
        'level_id' => 'required|integer|exists:levels,id',
    ]);

    // Get the level ID from the request and the authenticated user ID
    $levelId = $request->input('level_id');
    $userId = $request->user()->id;

    // Log level and user ID
    Log::info('Troubled Questions Request:', ['level_id' => $levelId, 'user_id' => $userId]);

    // Retrieve all exam IDs for the given level
    $examIds = Exam::where('level_id', $levelId)->pluck('id')->toArray();

    if (empty($examIds)) {
        return response()->json([
            'status' => false,
            'message' => 'No exams found for this level.'
        ], 404);
    }

    Log::info('Exam IDs for level ' . $levelId, ['exam_ids' => $examIds]);

    // Get troubled questions, excluding those with remaining_repeats = 0 or null
    $troubledQuestions = UserResponse::where('user_id', $userId)
        ->whereIn('exam_id', $examIds)
        ->where(function ($query) {
            $query->where('incorrect_count', '>=', 3)
                  ->orWhere(function ($subQuery) {
                      $subQuery->where('correct_count', '>=', 5)
                               ->whereNotNull('incorrect_count');
                  });
        })
        ->whereNotNull('remaining_repeats')
        ->where('remaining_repeats', '>', 0)
        ->get(['question_id', 'remaining_repeats', 'incorrect_count', 'updated_at','status']);

    // Filter out questions where user_response.updated_at is older than the latest option.updated_at
    // $filteredQuestions = $troubledQuestions->filter(function ($response) {
    //     $optionUpdateTime = Option::where('question_id', $response->question_id)
    //         ->max('updated_at'); // Get the latest updated_at from options

    //     return $response->updated_at >= $optionUpdateTime;
    // });
    
    
    $filteredQuestions = $troubledQuestions->filter(function ($response) {
    $optionUpdateTime = Option::where('question_id', $response->question_id)
        ->max('updated_at');

    // Always include if status is 'troubled'
    if ($response->status === 'troubled') {
        return true;
    }

    return $response->updated_at >= $optionUpdateTime;
});


    if ($filteredQuestions->isEmpty()) {
        return response()->json([
            'status' => false,
            'message' => 'No troubled questions found for this level.'
        ], 404);
    }

    Log::info('Troubled Questions after filtering:', $filteredQuestions->toArray());

    // Fetch the detailed question data
    $questionDetails = Question::with(['options' => function ($query) {
            $query->select('id', 'question_id', 'option', 'is_correct',);
        }])
        ->whereIn('id', $filteredQuestions->pluck('question_id'))
        ->select('id', 'exam_id', 'question', 'image','reason')
        ->get()
        ->keyBy('id'); // Use keyBy for easy referencing

    Log::info('Question Details after keyBy:', $questionDetails->keys()->toArray());

    // Process troubled questions and apply repetitions
    $finalQuestions = [];
    foreach ($filteredQuestions as $troubledQuestion) {
        if ($troubledQuestion->incorrect_count >= 0 && $troubledQuestion->remaining_repeats > 0) {
           if (isset($questionDetails[$troubledQuestion->question_id])) {
    $finalQuestions[] = $questionDetails[$troubledQuestion->question_id];
} else {
    Log::warning('Missing question details for question_id: ' . $troubledQuestion->question_id);
}

        }
    }

    $totalQuestions = count($finalQuestions);

    Log::info('Final Questions being returned:', ['total_questions' => $totalQuestions, 'final_questions' => $finalQuestions]);

    return response()->json([
        'status' => true,
        'total_questions' => $totalQuestions,
        'troubled_questions' => $finalQuestions,
    ]);
}

public function masteredQuestions(Request $request)
{
    $request->validate([
        'level_id' => 'required|integer|exists:levels,id',
    ]);

    $levelId = $request->input('level_id');
    $userId = $request->user()->id;

    // Retrieve all exam IDs for the given level
    $examIds = Exam::where('level_id', $levelId)->pluck('id')->toArray();

    // If no exams found for the level, return a 404 response
    if (empty($examIds)) {
        return response()->json([
            'status' => false,
            'message' => 'No exams found for this level.'
        ], 404);
    }

    // Retrieve questions where the user has mastered them
    $masteredQuestionIds = UserResponse::where('user_id', $userId)
        ->whereIn('exam_id', $examIds)
        ->where('correct_count', '>=', 1) // Only include questions with correct_count >= 1
        ->where('remaining_repeats', 0) // Only include questions with 0 remaining repeats
        ->get(['question_id', 'updated_at']);

    // Exclude questions where response update time is older than the question update time
   $filteredQuestionIds = $masteredQuestionIds->filter(function ($response) {
        $questionUpdateTime = Question::where('id', $response->question_id)
            ->value('updated_at');

        $optionUpdateTime = Option::where('question_id', $response->question_id)
            ->max('updated_at'); // Get the latest updated_at from options

        return $response->updated_at >= $questionUpdateTime && $response->updated_at >= $optionUpdateTime;
    })->pluck('question_id')->toArray();

    // If no mastered questions, return a message indicating no such questions
    if (empty($filteredQuestionIds)) {
        return response()->json([
            'status' => false,
            'message' => 'No mastered questions found for this level.'
        ], 404);
    }

    // Fetch questions based on the filtered question IDs
    $questions = Question::with(['options' => function ($query) {
            $query->select('id', 'question_id', 'option', 'is_correct');
        }])
        ->whereIn('id', $filteredQuestionIds)
        ->select('id', 'exam_id', 'question', 'image','reason')
        ->get();

    $totalQuestions = $questions->count();

    return response()->json([
        'status' => true,
        'total_questions' => $totalQuestions,
        'remaining_questions' => null,
        'mastered_questions' => $questions,
    ]);
}





public function deleteSoftDeletedQuestionResponses()
{
    // Get IDs of soft-deleted questions
    $softDeletedQuestionIds = Question::onlyTrashed()->pluck('id');

    // Delete user_responses linked to those questions
    $deletedCount = UserResponse::whereIn('question_id', $softDeletedQuestionIds)->delete();

    return response()->json([
        'message' => "$deletedCount user responses deleted where related questions were soft-deleted.",
        'deleted_count' => $deletedCount,
    ]);
}


public function deleteLatestUserResponsesPerExam()
{
    // Get the latest response ID for each (user_id, exam_id) pair
    $latestIds = UserResponse::select(DB::raw('MAX(id) as id'))
        ->groupBy('user_id', 'exam_id')
        ->pluck('id');

    // Delete those entries
    $deletedCount = UserResponse::whereIn('id', $latestIds)->delete();

    return response()->json([
        'message' => "$deletedCount latest user responses deleted (1 per user per exam).",
        'deleted_count' => $deletedCount,
    ]);
}



public function examReappear(Request $request)
{
    $request->validate([
        'exam_id' => 'required',
    ]);

    $examId = $request->input('exam_id');
    $userId = $request->user()->id;
     \DB::table('user_progress')
        ->where('user_id', $userId)
        ->where('exam_id', $examId)
        ->update(['reappear' => true]);
   
    UserResponse::where('user_id', $userId)
        ->where('exam_id', $examId)
        ->delete();

    \Log::info("User reset exam responses only", [
        'user_id' => $userId,
        'exam_id' => $examId,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Exam can now be reattempted.',
    ]);
}

public function examMode(Request $request)
{
    $request->validate([
        'exam_id' => 'required|integer',
    ]);

    $examId = $request->input('exam_id');

    // Fetch questions for the given exam
    $questions = Question::where('exam_id', $examId)
        ->whereNull('deleted_at')
        ->select('id', 'exam_id', 'question', 'image', 'image_position', 'reason', 'created_at', 'updated_at')
        ->get();

    if ($questions->isEmpty()) {
        return response()->json([
            'status' => false,
            'message' => 'No questions found for this exam.',
        ], 404);
    }

    // Fetch options for all questions
    $options = Option::whereIn('question_id', $questions->pluck('id'))
        ->select('id', 'question_id', 'option', 'is_correct', 'updated_at')
        ->get()
        ->groupBy('question_id');

    // Attach shuffled options to each question
    $finalQuestions = $questions->map(function ($question) use ($options) {
        $question->options = ($options[$question->id] ?? collect())->shuffle()->values();
        return $question;
    });

    return response()->json([
        'status' => true,
        'exam_id' => $examId,
        'total_questions' => $finalQuestions->count(),
        'questions' => $finalQuestions,
    ]);
}





    

    
}
