<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question; 
use App\Models\Exam;
use App\Models\UserResponse;
use App\Models\Option; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class QuestionController extends Controller
{
    public function showQuestions($examId)
{
  
    $exam = Exam::findOrFail($examId); 
    $questions = Question::with('admin:id,name')->where('exam_id', $examId)->get(); 

    return view('admin.viewquestion', compact('exam', 'questions'));
}

public function create($examId)
{
    return view('admin.addQuestion', compact('examId'));
}


public function store(Request $request, $examId)
{
    $request->validate([
        'question' => 'required|string|max:255',
        'image' => 'nullable|image', 
        'options.*.option' => 'required',
        'options.*.is_correct' => 'nullable|boolean',
    ]);
     $validated['admin_id'] = auth()->id();

  
    $imagePath = null;

    // Check if an image file was uploaded
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $destinationPath = public_path('assets/images');
        $request->file('image')->move($destinationPath, $imageName);
         $imagePath = url('assets/images/' . $imageName);
    }

    // Create the question, setting 'image' field only if $imagePath is set
    $question = Question::create([
        'exam_id' => $examId,
        'question' => $request->question,
        'image' => $imagePath,
        'image_position' => $request->image_position,
         'reason' => $request->reason,
        'admin_id' => $validated['admin_id'],
    ]);

    // Create options for the question
    foreach ($request->options as $option) {
        Option::create([
            'question_id' => $question->id,
            'option' => $option['option'],
            'is_correct' => $option['is_correct'] ?? false,
        ]);
    }

    return redirect()->route('show-questions', $examId)->with('success', 'Question added successfully!');
}

public function edit($examId, $questionId)
{
    $question = Question::with('options')->findOrFail($questionId);
    return view('admin.viewEditQuestion', compact('question', 'examId'));
}

public function update(Request $request, $examId, $questionId)
{
    
        $request->validate([
            'question' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'options.*.option' => 'required|string',
            'options.*.is_correct' => 'nullable|boolean',
        ]);
    
        $question = Question::findOrFail($questionId);
        
        // Handle the uploaded image if it exists
        $imagePath = $question->image; // Keep the old image path if no new image is uploaded
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $destinationPath = public_path('assets/images');
            $request->file('image')->move($destinationPath, $imageName);
            $imagePath = url('assets/images/' . $imageName);
        }
    
        // Update the question
        $question->update([
            'question' => $request->question,
            'image' => $imagePath,
            'image_position' => $request->image_position,
            'reason' => $request->reason,
        ]);
    
        // Update existing options
        foreach ($request->options as $option) {
            // Ensure that the ID exists before updating
            if (isset($option['id'])) {
                Option::where('id', $option['id'])->update([
                    'option' => $option['option'],
                    'is_correct' => isset($option['is_correct']) ? 1 : 0, // Convert checkbox input to 1 or 0
                ]);
            }
        }
    
        return redirect()->route('show-questions', $examId)
        ->with('success', 'Question updated successfully!');
}

public function show($examId, $questionId)
{
    $question = Question::with('options')->findOrFail($questionId);
    
    return view('admin.viewSingleQuestion', compact('question', 'examId'));
}

public function destroy($examId, $questionId)
{
    
    $question = Question::findOrFail($questionId);

   
    $question->options()->delete();
    $question->delete();
    
    $latestIds = UserResponse::select(DB::raw('MAX(id) as id'))
        ->where('exam_id', $examId) // only responses for this exam
        ->groupBy('user_id', 'exam_id')
        ->pluck('id');

    $deletedCount = UserResponse::whereIn('id', $latestIds)->delete();

    return redirect()->route('show-questions', $examId)
        ->with('success', 'Question and its options deleted successfully!');
}


public function bulkDelete(Request $request)
{
    $questionIds = $request->input('question_ids');

    if (!empty($questionIds)) {
        // Get exam_id(s) from the questions being deleted
        $examIds = Question::whereIn('id', $questionIds)
            ->pluck('exam_id')
            ->unique();

        foreach ($questionIds as $id) {
            $question = Question::with('options')->find($id);
            if ($question) {
                $question->options()->delete(); // delete related options
                $question->delete(); // delete question
            }
        }

        // For each exam_id, delete the latest user responses
         $deletedCount = UserResponse::whereIn('exam_id', $examIds)
            ->whereIn('question_id', $questionIds)
            ->delete();
    }

    return back()->with('success', 'Selected questions deleted successfully.');
}



    


}



    
    

