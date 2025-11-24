<?php

namespace App\Http\Controllers; // Use the correct namespace

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
   public function login(Request $request)
{
   

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      
        
        $user = Auth::user();

        if ($user->usertype == 'admin') {
            return redirect()->route('getuser');
        } elseif ($user->usertype == 'subadmin') {
            if ($user->active == 'active') {
                return redirect()->route('levelview');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Your account is deactivated. Please contact the administrator.']);
            }
        } else {
            Auth::logout();
            return redirect()->back()->withErrors(['email' => 'You are not authorized to access this page.']);
        }
    }

  

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


    public function logout(Request $request)
    {
       
        Auth::logout();

       
        $request->session()->invalidate();

        
        $request->session()->regenerateToken();

       
        return redirect()->route('login')->with('status', 'Successfully logged out.');
    }


}
