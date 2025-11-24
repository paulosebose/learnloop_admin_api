<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail; // Import the Mailable class

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Import User model if not already done

class MailController extends Controller
{
  
    public function forgotPassword(Request $request)
{
    // Validate the request
    $request->validate([
        'email' => 'required|email',
    ]);

    // Find user by email
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'No account found with this email address.',
        ], 404);
    }


    // Generate a random password with 6 lowercase letters
    $newPassword = Str::lower(Str::random(8));

    // Update user's password in the database
    $user->password = Hash::make($newPassword);
    $user->save();

    // Send the new password to the user's email
    if (Mail::to($user->email)->send(new PasswordResetMail($newPassword))) {
        return response()->json([
             'status' => true,
            'message' => 'A new password has been sent to your email address.',
           
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Error sending email.',
            
        ], 500);
    }
}
    
}
