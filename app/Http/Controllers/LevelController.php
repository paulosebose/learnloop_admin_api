<?php

namespace App\Http\Controllers;

use App\Models\Level;

use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LevelController extends Controller
{
   public function getLevels()
   {
       $user = Auth::user();
   if ($user->usertype === 'subadmin') {
        // Get the subadmin's subject_id from users table
        $subadminSubjectId = $user->subject_id;

        // Fetch levels where subject_id matches the subadmin's assigned subject
        $levels = Level::where('subject_id', $subadminSubjectId)
                       ->latest()
                       ->get();

        // Fetch the subject assigned to this subadmin
        $subjects = Subject::where('id', $subadminSubjectId)
                           ->withoutTrashed()
                           ->get();
       
   }
                           else {
        // Admin can see everything
        $subjects = Subject::withoutTrashed()->get();
        $levels = Level::latest()->get();
    }
    return view('admin.levels', compact('levels', 'subjects'));
   }
    public function getLevelById($id)
   {
       $user = Auth::user();
   if ($user->usertype === 'subadmin') {
        // Get the subadmin's subject_id from users table
        $subadminSubjectId = $user->subject_id;

        // Fetch levels where subject_id matches the subadmin's assigned subject
        $levels = Level::where('subject_id', $subadminSubjectId)
                       ->latest()
                       ->get();

        // Fetch the subject assigned to this subadmin
        $subjects = Subject::where('id', $subadminSubjectId)
                           ->withoutTrashed()
                           ->get();
       
   }
                           else {
        // Admin can see everything
        $subjects = Subject::withoutTrashed()->get();
        $levels = Level::where('subject_id', $id)->latest()->get();
    }
    return view('admin.levels', compact('levels', 'subjects'));
   }
   public function insertlevel(Request $request)
   
   {
      
    $request->validate([
        'level_name' => 'required',
         'subject_id' => 'required',
        
       
    ]);

    $imagePath = null;

 
    // if ($request->hasFile('image') && $request->file('image')->isValid()) {
    //     $imagePath = $request->file('image')->storeAs('public/app-assets/images/levels', $request->file('image')->getClientOriginalName(), 'public');
    // } else {
    //     return back()->with('error', 'File upload failed or the file is not valid.');
    // }

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('assets/images');
    
     
        $image->move($destinationPath, $imageName);
    
  
        // $imagePath = 'assets/images/' . $imageName;
          $imagePath = url('assets/images/' . $imageName);
    }
     $paid = $request->has('paid') ? 1 : 2;
    
    try {
     
        DB::table('levels')->insert([
            'level_name' => $request->level_name,
            'image' => $imagePath,
             'subject_id' => $request->subject_id,
              'paid' => $paid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
     
    } catch (\Exception $e) {
        // Log error details if insertion fails
        Log::error('Error inserting level: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to add level');
    }

    // Redirect back with success message
    return redirect()->back()->with('success', 'Quiz Level Added');
}

public function viewEditLevel($id)
{
    $level=Level::findOrFail($id);
    $subjects = Subject::all(); 

    return view('admin.viewEditLevel', compact('level', 'subjects'));
   

}

public function editLevel(Request $request, $id)
{
    $request->validate([
        'level_name' => 'required',
        'image' => 'nullable',
         'subject' => 'nullable|exists:subjects,id',
    ]);

    
    $level = Level::findOrFail($id);
    $level->level_name = $request->level_name;
      if ($request->has('subject')) {
        $level->subject_id = $request->subject; 
    }
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $destinationPath = public_path('assets/images');
        $request->file('image')->move($destinationPath, $imageName);
        $level->image = url('assets/images/' . $imageName);
    }
     if ($request->has('paid')) {
        $level->paid = $request->paid; // Update the 'paid' field
    }
    $level->save();
    return redirect()->back()->with('success', 'Quiz Level Updated Successfully');
}

public function deleteLevel($id)
{
    $level=Level::findOrFail($id);
    $imagePath = public_path($level->image);
    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath); // Delete the file
    } else {
        // Log a message if the file does not exist
        Log::info('Image file does not exist or is not a valid file.', ['path' => $imagePath]);
    }
    $level->delete();
    return redirect()->back()->with('Sucess','Deleted Successfully');
}



}
