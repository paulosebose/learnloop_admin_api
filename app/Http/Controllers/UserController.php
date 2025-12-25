<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserProgress;
use App\Models\Level;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\UserResponse;
use App\Models\Question;
use App\Models\LevelAccess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\SubjectAccess;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        $users=User::select('id','name','email','mobile','status')->whereNotIn('usertype', ['admin', 'subadmin'])->paginate(10);
           Log::info('Retrieved Users:', $users->toArray());
       
        return view('admin.dashboard',compact('users'));
    }
    public function viewUserRequets()
    {
        $users=User::select('id','name','email','created_at','status','mobile')
     ->whereNotIn('usertype', ['admin', 'subadmin'])
        ->where('status', 0)
        ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
        ->orderBy('created_at', 'asc')->paginate(10);
        return view('admin.userrequest',compact('users'));
    }
    public function approve($id)
    {
        
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

      
        $user->status = 1;
        $user->save();

        return redirect()->back()->with('success', 'User request approved successfully');
    }

    public function reject($id)
    {
       
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

       
        $user->status = 2;
        $user->save();

        return redirect()->back()->with('success', 'User request rejected successfully');
    }
    public function showUserStatus()
{
    // Directly return the view without passing any data
    return view('admin.userStatus');
}
public function showUserQuizStatus($id)
{
    // Find user by ID
    $user = User::find($id);

    // Initialize variables for empty fields
    $name = '';
    $email = '';
      $mobile = 'N/A';
    $levelName = '';
    $examName = '';
    $answeredQuestionsCount = 0;
    $totalQuestionsCount = 0;
    $quizStatus = 'N/A';
      $levels = [];
        $subjects = [];

    // Check if user exists
    if ($user) {
          $name = $user->name;
        $email = $user->email;
        $mobile = $user->mobile ?? 'N/A';
        $status = null; 
        // Get the last user progress
        $userProgress = UserProgress::where('user_id', $user->id)->latest()->first();

        // Get the quiz level based on user progress
        if ($userProgress) {
            $level = Level::find($userProgress->level_id);
            $levelName = $level ? $level->level_name : 'N/A';

            // Get the last exam based on user progress
            $exam = Exam::find($userProgress->exam_id);
            $examName = $exam ? $exam->exam_name : 'N/A';

            // Count answered questions for the given exam ID
            $answeredQuestionsCount = UserResponse::where('user_id', $user->id)
                ->where('exam_id', $exam->id) // Filter by exam ID
                ->count();

            // Get the total count of questions for the given exam ID
            $totalQuestionsCount = Question::where('exam_id', $exam->id)->count();

            // Check the exam accessibility status
            $quizStatus = $userProgress->exam_accessible ? 'Completed' : 'In Progress';
        }
          $levels = Level::where('paid', 1)->get();
               foreach ($levels as $level) {
            // Check if there's an entry for the user and level in the level_accessibility table
            $levelAccess = LevelAccess::where('user_id', $user->id)
                ->where('level_id', $level->id)
                ->first();

            // Dynamically add 'isAccessible' to the level object
            $level->isAccessible = $levelAccess ? $levelAccess->is_accessible : 0;
            $subject = Subject::find($level->subject_id);
            $level->subject_name = $subject ? $subject->subject_name : 'N/A';
        }
        
        // Assign user details if user exists
        $name = $user->name;
         $totalTime = $user->total_time;
        $email = $user->email;
         $status = $user->status;
         $subjects = Subject::whereNull('deleted_at')->get();

       
    }

    return view('admin.userStatus', compact(
        'id',
        'totalTime',
        'name', 
        'email',
        'status',
         'mobile',
        'levelName', 
        'examName', 
        'answeredQuestionsCount', 
        'totalQuestionsCount', 
        'quizStatus',
         'levels',
         'subjects'
    ));
}


public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = auth()->user();

    // Check if the current password matches
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect']);
    }

    // Update the password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully');
}



public function showChangePasswordForm()
{
    return view('admin.changepassword'); // Ensure this view exists
}


public function updateSubjectAccess(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'subject_id' => 'required|exists:subjects,id',
        'accessibility' => 'required|boolean',
    ]);

    $access = SubjectAccess::updateOrCreate(
        [
            'user_id' => $validated['user_id'],
            'subject_id' => $validated['subject_id']
        ],
        [
            'accessibility' => $validated['accessibility']
        ]
    );

    return response()->json(['success' => true]);
}


public function updateLevelAccess(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'level_id' => 'required|exists:levels,id',
        'accessibility' => 'required|boolean',
    ]);

    if ($validated['accessibility']) {
        // Insert the record only when the checkbox is checked
        LevelAccess::updateOrCreate(
            [
                'user_id' => $validated['user_id'],
                'level_id' => $validated['level_id'],
            ],
            [
                'accessibility' => 1,
            ]
        );
    } else {
        // Optional: Remove the record when the checkbox is unchecked
        LevelAccess::where([
            ['user_id', '=', $validated['user_id']],
            ['level_id', '=', $validated['level_id']],
        ])->delete();
    }

    return response()->json(['success' => true]);
}

public function userSearch(Request $request)
{
    $search = $request->input('search');
    
    $users = User::query()
                 ->when($search, function ($query, $search) {
                     return $query->where('name', 'like', "%{$search}%");
                 })
                 ->paginate(10); // Adjust per page count as needed

    return view('admin.dashboard', compact('users'));
}


         public function index()
        {
            
            $subAdmins = User::where('usertype', 'subadmin')->get(); 

           
            return view('admin.listSubadmin', compact('subAdmins'));
        }
        
        
        public function showAddSubadminForm()
        {
            $subjects = Subject::all(); // get all subjects
    return view('admin.addSubadmin', compact('subjects'));
        }
        
        
        public function addSubadmin(Request $request)
{
   
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed', 
        'subject_id' => 'required|exists:subjects,id',
    ]);

    try {
       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->phone,
            'password' => Hash::make($request->password),
            'usertype' => 'subadmin', 
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->back()->with('success', 'Sub Admin created successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to create Sub Admin: ' . $e->getMessage());
    }
}


 public function subAdminDelete($id)
        {
            
            $subadmin = User::findOrFail($id);
            
         
            $subadmin->delete();
    
           
            return redirect()->route('subadmin.index')->with('success', 'Subadmin has been deleted.');
        }
        
         public function edit($id)
        {
            $subadmin = User::findOrFail($id);
    
           $subjects = Subject::all(); 

    return view('admin.editSubadmin', compact('subadmin', 'subjects'));
        }
    
    
        public function update(Request $request, $id)
        {
          
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                 'password' => 'nullable|min:8',
                
            ]);
    
           
            $subadmin = User::findOrFail($id);
    
          
            $subadmin->name = $request->input('name');
            $subadmin->email = $request->input('email');
            if ($request->filled('password')) {
                $subadmin->password = bcrypt($request->input('password'));
            }
            $subadmin->mobile = $request->input('mobile');
            $subadmin->subject_id = $request->input('subject_id');
        
         
        
            $subadmin->save();
    
          
            return back()->with('success', 'Subadmin updated successfully.');
        }
        
        
public function toggleStatus(Request $request, $id)
{
    $request->validate([
        'active' => 'required|string',
    ]);

    $subAdmin = User::findOrFail($id);

    // Ensure we are using the correct value for 'active' or 'inactive'
    if ($request->active === 'active') {
        $subAdmin->active = 'active';  // Set 'active' status
        $message = 'Sub-Admin activated successfully.';
    } else {
        $subAdmin->active = 'inactive';  // Set 'inactive' status
        $message = 'Sub-Admin deactivated successfully.';
    }

    $subAdmin->save();  // Save the changes to the database

    return response()->json([
        'message' => $message,  // Return the message
        'status' => $subAdmin->active,  // Return the updated status
    ]);
}


public function studentDetails(Request $request)
{
    $users = collect(); // empty collection by default

    if ($request->has('mobile')) {
        $users = User::where('mobile', $request->mobile)
                     ->where('usertype', 'user')
                     ->get();
    }

    return view('admin.studentdetails', compact('users'));
}









}
