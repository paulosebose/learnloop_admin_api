<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Question;
use App\Models\Option;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    
    
    
public function uploadCSV(Request $request)
{
    
        \Log::info('.......................................................uploadCSV function called.');
    // Validate the uploaded CSV file
   try {
  $request->validate([
    'csv_file' => 'required|file',
]);

    \Log::info('Starting CSV upload process.');
} catch (\Illuminate\Validation\ValidationException $e) {
    \Log::error('Validation failed.', ['errors' => $e->errors()]);
    return back()->withErrors($e->errors());
}

    // Log the start of the process
    \Log::info('Starting CSV upload process.');

    $file = $request->file('csv_file');
    $path = $file->getRealPath();

    // Log file upload success
    \Log::info('CSV file uploaded successfully.', ['path' => $path]);

    // Read CSV file
    $data = array_map('str_getcsv', file($path));
   $header = array_shift($data); // Extract header row

// Normalize header values
$normalizedHeader = array_map('strtolower', array_map('trim', $header));
$expectedHeaders = ['exam_id', 'question', 'option_1', 'option_2', 'option_3', 'option_4', 'option_5', 'image', 'correct_option', 'reason'];

if ($normalizedHeader !== $expectedHeaders) {
    \Log::error('Invalid CSV format.', ['header' => $normalizedHeader]);
    return back()->with('error', 'Invalid CSV format. Header mismatch.');
}



   foreach ($data as $rowIndex => $row) {
    $row = array_map('trim', $row); // Trim whitespace

    // ✅ Validate row has exactly 10 columns
    if (count($row) !== 10) {
        \Log::warning('Skipping malformed row.', [
            'row_index' => $rowIndex + 2, // +2 to account for header and 0-based index
            'row_data' => $row
        ]);
        continue;
    }

    // ✅ Now it's safe to extract
    list($exam_id, $questionText, $option1, $option2, $option3, $option4, $option5, $imageName, $correctOption, $reason) = $row;


        // Save question
        $question = new Question();
        $question->exam_id = $exam_id;
        $question->question = $questionText;
        $question->reason = $reason;

        // Save image if exists
        if (!empty($imageName) && file_exists(public_path('assets/images/' . $imageName))) {
            $question->image = 'assets/images/' . $imageName;
        }
        $question->save();

        // Log question save success
        \Log::info('Question saved.', ['question_id' => $question->id]);

        // Save options
        $options = [$option1, $option2, $option3, $option4, $option5];
        foreach ($options as $index => $optionText) {
            if (!empty($optionText)) {
                $option = new Option();
                $option->question_id = $question->id;
                $option->option = $optionText;  // Corrected column name
                $option->is_correct = ($correctOption === 'option_' . ($index + 1)) ? 1 : 0;  // Fixed option naming
                $option->save();
            }
        }
    }

    \Log::info('CSV upload process completed successfully.');
    return back()->with('success', 'CSV uploaded successfully!');
}   
    public function examview($id)
{
    $level = Level::findOrFail($id); 
    $exams = Exam::where('level_id', $id)->get(); 
     $allSubjects = Subject::with(['levels.exams'])->get();

    // Return all data to the same view
    return view('admin.viewexams', compact('level', 'exams', 'allSubjects'));
}

public function importExam(Request $request)
{
    $request->validate([
        'exam_id' => 'required|exists:exams,id',
        'level_id' => 'required|exists:levels,id',
    ]);

    // 1. Load exam with its questions + answers
    $exam = Exam::with('questions.options')->findOrFail($request->exam_id);

    // 2. Clone the exam itself
    $newExam = $exam->replicate();
    $newExam->exam_name = $exam->exam_name . ' (Copy)';
     $newExam->level_id = $request->level_id;
    $newExam->push();

    // 3. Clone questions & answers
    foreach ($exam->questions as $question) {
        $newQuestion = $question->replicate();
        $newQuestion->exam_id = $newExam->id;
        $newQuestion->push();

        foreach ($question->options as $answer) {
            $newAnswer = $answer->replicate();
            $newAnswer->question_id = $newQuestion->id;
            $newAnswer->push();
        }
    }

    return redirect()->back()->with('success', 'Exam and all questions with answers copied successfully.');
}


public function viewAddExam($id)
{
    $level = Level::findOrFail($id); 
    return view('admin.addexam',compact('level'));
}

public function insertExam(Request $request)
{
    $request->validate([
        'exam_name' => 'required|string|max:255',
        'image' => 'nullable',
        'level_id' => 'required|exists:levels,id',
    ]);
 $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('assets/images');
    
     
        $image->move($destinationPath, $imageName);
    
  
        $imagePath = url('assets/images/' . $imageName);
    }
    
  
    Exam::create([
        'exam_name' => $request->exam_name,
        'image' => $imagePath, 
        'level_id' => $request->level_id,
    ]);

    return redirect()->route('examview', ['id' => $request->level_id])->with('success', 'Exam added successfully!');
}

public function editExam($id)
{
   
    $exam = Exam::findOrFail($id); 
    $level = $exam->level; 

    return view('admin.viewEditExam', compact('exam', 'level','id'));
    
}

public function updateExam(Request $request, $id)
{
    $request->validate([
        'exam_name' => 'required|string|max:255',
        'level_id' => 'required|exists:levels,id',
        'image' => 'nullable',
    ]);

    $exam = Exam::findOrFail($id);
    $exam->exam_name = $request->exam_name;

   
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $destinationPath = public_path('assets/images');
        $request->file('image')->move($destinationPath, $imageName);
        $exam->image = url('assets/images/' . $imageName);
    }

    $exam->level_id = $request->level_id;
    $exam->save();

    return redirect()->back()->with('success', 'Exam Updated Successfully');
}

public function deleteExam($id)
{
    $exam = Exam::findOrFail($id);
    $exam->delete(); 

    return redirect()->back()->with('success', 'Exam deleted successfully.');
}



public function toggleExamStatus($id)
{
    $exam = Exam::findOrFail($id);
    $exam->status = !$exam->status;  // Toggle status
    $exam->save();

    return redirect()->back()->with('success', 'Exam status updated successfully!');
}



public function deleteMultipleExams(Request $request)
{
    $ids = $request->ids;

    if ($ids && is_array($ids)) {
        Exam::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Selected exams deleted successfully.');
    }

    return redirect()->back()->with('error', 'No exams selected for deletion.');
}







}
