<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;


class SubjectController extends Controller
{
    public function insertSubject(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('assets/images');
    
     
        $image->move($destinationPath, $imageName);
    
  
        // $imagePath = 'assets/images/' . $imageName;
          $imagePath = url('assets/images/' . $imageName);
    }
       
        $subject = Subject::create([
            'subject_name' => $request->input('subject_name'),
            'image' => $imagePath,
            'duration'     => $request->input('duration'),
            'amount' => $request->input('amount'),
            'admin_id' => Auth::id(),
        ]);

       return redirect()->back()->with('success', 'Subject Added');
    }
    
    
    public function viewAddSubject()
    {
   return view('admin.addSubject');
    }
    
    
  public function getSubjects()
{
 $subjects = Subject::when(
        Auth::user()->usertype === 'subadmin',
        function ($query) {
            $query->where('admin_id', Auth::id());
        }
    )->latest()->get();
    return view('admin.viewSubjects', compact('subjects')); 
}


public function edit($id)
{
    $subject = Subject::findOrFail($id); 
    return view('admin.editSubject', compact('subject')); 
}

public function update(Request $request, $id)
{
    $request->validate([
        'subject_name' => 'required|string|max:255',
         'image' => 'nullable',
    ]);

    $subject = Subject::findOrFail($id);

    $imagePath = $subject->image; 

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $destinationPath = public_path('assets/images');
        $request->file('image')->move($destinationPath, $imageName);
        $subject->image = url('assets/images/' . $imageName);
    }

    $subject->update([
        'subject_name' => $request->input('subject_name'),
        'duration'     => $request->input('duration'),
        'amount' => $request->input('amount'),
        'image' => $imagePath,
    ]);

    return redirect()->route('viewSubjects')->with('success', 'Subject updated successfully.');
}

public function destroy($id)
{
    $subject = Subject::findOrFail($id);
    $subject->delete();
    return redirect()->route('viewSubjects')->with('success', 'Subject deleted successfully.');
}


}
