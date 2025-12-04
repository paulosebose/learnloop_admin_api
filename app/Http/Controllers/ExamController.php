<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use App\Models\Level;
use App\Models\Question;
use App\Models\Option;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;

use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;

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


public function processDocUpload(Request $request, $examId)
{
    $request->validate([
        'doc_file' => 'required|mimes:docx,doc',
    ]);

    $uploaded = $request->file('doc_file');
    $filename = time() . '.' . $uploaded->getClientOriginalExtension();
    $destinationPath = storage_path('app/docs');

    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
    }

    $uploaded->move($destinationPath, $filename);
    $filePath = $destinationPath . '/' . $filename;

    if (!file_exists($filePath)) {
        return back()->with('error', 'File not found after upload.');
    }

    try {
        $phpWord = IOFactory::load($filePath);
    } catch (\Exception $e) {
        return back()->with('error', 'Cannot read DOCX file: ' . $e->getMessage());
    }

    $admin_id = Auth::user()->id;
    $questions = [];
    $currentQuestion = null;

    // Parse tables from DOCX
    foreach ($phpWord->getSections() as $section) {
        foreach ($section->getElements() as $element) {
            // Check if element is a table
            if (get_class($element) === 'PhpOffice\PhpWord\Element\Table') {
                $table = $element;
                $questionText = '';
                $questionType = '';
                $options = [];
                $solution = '';
                $marks = '';

                // Loop through table rows
                foreach ($table->getRows() as $row) {
                    $cells = $row->getCells();
                    
                    if (count($cells) >= 2) {
                        $firstCell = $this->getCellText($cells[0]);
                        $secondCell = $this->getCellText($cells[1]);
                        $thirdCell = isset($cells[2]) ? $this->getCellText($cells[2]) : '';

                        // Parse each row based on first cell content
                        if (stripos($firstCell, 'Question') !== false) {
                            $questionText = trim($secondCell);
                        } 
                        elseif (stripos($firstCell, 'Type') !== false) {
                            $questionType = trim($secondCell);
                        } 
                        elseif (stripos($firstCell, 'Option') !== false) {
                            $optionText = trim($secondCell);
                            $isCorrect = (stripos($thirdCell, 'correct') !== false && stripos($thirdCell, 'incorrect') === false);
                            
                            $options[] = [
                                'option' => $optionText,
                                'is_correct' => $isCorrect
                            ];
                        } 
                        elseif (stripos($firstCell, 'Solution') !== false) {
                            $solution = trim($secondCell);
                        } 
                        elseif (stripos($firstCell, 'Marks') !== false) {
                            $marks = trim($secondCell);
                        }
                    }
                }

                // Add question if we have the required data
                if (!empty($questionText) && !empty($options)) {
                    $questions[] = [
                        'question' => $questionText,
                        'type' => $questionType,
                        'options' => $options,
                        'solution' => $solution,
                        'marks' => $marks
                    ];
                }
            }
        }
    }

    // Check if questions were parsed
    if (empty($questions)) {
        unlink($filePath);
        return back()->with('error', 'No questions found in the document. Please check the format.');
    }

    // Save questions and options to database
   // Save questions and options to database
$savedCount = 0;
$skippedCount = 0;
foreach ($questions as $q) {

    // Clean question text (fix DOCX formatting issues)
    $cleanQuestion = trim(preg_replace('/\s+/', ' ', $q['question']));

    if ($cleanQuestion === '') {
       
        continue; // skip empty question
    }

    // Check duplicate in DB
    $exists = Question::where('exam_id', $examId)
                      ->where('question', $q['question'])
                      ->exists();

    if ($exists) {
        $skippedCount++;
        continue; // skip if already exists
    }

    try {
        // Save question
        $question = Question::create([
            'exam_id' => $examId,
            'question' => $cleanQuestion,
            'admin_id' => $admin_id,
           // 'marks' => $q['marks'] ?? 1,
            'solution' => $q['solution'] ?? null,
        ]);

        // Save options
        foreach ($q['options'] as $opt) {
            Option::create([
                'question_id' => $question->id,
                'option' => $opt['option'],
                'is_correct' => $opt['is_correct'],
            ]);
        }
        Option::create([
    'question_id' => $question->id,
    'option' => 'Not Sure', // <-- change as needed
    'is_correct' => false,
]);

        $savedCount++;

    } catch (\Exception $e) {
        \Log::error('Error saving question: ' . $e->getMessage());
    }
}


    // Delete uploaded file
    unlink($filePath);

    return back()->with('success',
    "$savedCount questions uploaded, $skippedCount duplicates skipped!"
);

}

// Helper method to extract text from table cell
// private function getCellText($cell)
// {
//     $text = '';
//     foreach ($cell->getElements() as $element) {
//         if (method_exists($element, 'getText')) {
//             $text .= $element->getText();
//         } elseif (method_exists($element, 'getElements')) {
//             foreach ($element->getElements() as $child) {
//                 if (method_exists($child, 'getText')) {
//                     $text .= $child->getText();
//                 }
//             }
//         }
//     }
//     return $text;
// }

private function getCellText($cell)
{
    $text = '';

    foreach ($cell->getElements() as $element) {
        if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
            foreach ($element->getElements() as $child) {
                if ($child instanceof \PhpOffice\PhpWord\Element\Text) {
                    $value = $child->getText();
                    $style = $child->getFontStyle();

                    // Convert to Unicode superscript
                    if ($style && method_exists($style, 'isSuperScript') && $style->isSuperScript()) {
                        $value = $this->toSuperscript($value);
                    }
                    // Convert to Unicode subscript
                    elseif ($style && method_exists($style, 'isSubScript') && $style->isSubScript()) {
                        $value = $this->toSubscript($value);
                    }

                    $text .= $value;
                }
            }
        }
        elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
            $text .= $element->getText();
        }
    }

    return $text;
}

private function toSuperscript($text)
{
    $map = [
        '0' => '⁰', '1' => '¹', '2' => '²', '3' => '³', '4' => '⁴',
        '5' => '⁵', '6' => '⁶', '7' => '⁷', '8' => '⁸', '9' => '⁹',
        '+' => '⁺', '-' => '⁻', '=' => '⁼', '(' => '⁽', ')' => '⁾'
    ];
    return strtr($text, $map);
}

private function toSubscript($text)
{
    $map = [
        '0' => '₀', '1' => '₁', '2' => '₂', '3' => '₃', '4' => '₄',
        '5' => '₅', '6' => '₆', '7' => '₇', '8' => '₈', '9' => '₉',
        '+' => '₊', '-' => '₋', '=' => '₌', '(' => '₍', ')' => '₎'
    ];
    return strtr($text, $map);
}
/**
 * Decode entities (including double-encoded), preserve existing <sup>/<sub>,
 * convert common patterns to <sup>/<sub>.
 */



}
