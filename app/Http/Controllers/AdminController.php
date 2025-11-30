<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Question; 

class AdminController extends Controller
{
 public function adminindex()
 {
    return view('admin.dashboard');
 }
 public function levelview()
 {
   return view('admin.levels');
 }
 

 public function userrequest()
 {
   return view('admin.userrequest');
 }
 public function addlevel()
 {
      $user = Auth::user();

    // If the user is a subadmin, fetch only their assigned subject
    if ($user->usertype === 'subadmin') {
        $subjects = Subject::withoutTrashed()
                    ->where('id', $user->subject_id)
                    ->get();
    } else {
        // Admin or other usertypes can see all subjects
        $subjects = Subject::withoutTrashed()->get();
    }

    return view('admin.addlevel', compact('subjects', 'user'));
 }
//  public function viewquestion()
//  {
//    return view('admin.viewquestion');
//  }

public function searchByQuestion(Request $request)
{
    //  Validate the input
    $request->validate([
        'search_by_question' => 'required'
    ]);

    // Get the search value
    $question_id = $request->search_by_question;

    //  Check if the question exists in the database
    // Example model: Question  (change to your model name)
    $question = Question::where('id',$question_id )->first();

    if (!$question) {
        //  If not found, return with an error message
        return back()->with('error', 'Question not found in the database!');
    }

    //  If found → get exam_id
     $examId = $question->exam_id;
    $questionId = $question->id;

    
    return redirect()->route('edit-question', [
        'examId'     => $examId,
        'questionId' => $questionId
    ]);
}

}
