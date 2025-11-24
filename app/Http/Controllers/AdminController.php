<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
}
