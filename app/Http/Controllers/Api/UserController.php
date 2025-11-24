<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;          
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registerUser(Request $request)
{
   
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ],);

   
   if ($validator->fails()) {
    return response()->json([
        'status' => false,
        'errors' => $validator->errors(),
    ], 422);
}


    try {
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
              'mobile' => $request->mobile ?? null,
            'status' => 0,     
            'usertype' => 'user', 
        ]);

        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        
      
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
             
            'data' => $user,
        ], 201);
    } catch (\Exception $e) {
       
        return response()->json([
            'status' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}

public function loginUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

       
        $user = User::where('email', $request->email)->first();

       
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

 
      
        $token = $user->createToken('auth_token')->plainTextToken;

      
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'data' => $user,
        ], 200);
    }

    public function logoutUser(Request $request)
    {
        try {
            // Attempt to retrieve the authenticated user
            $user = $request->user();
            
            if (!$user) {
                // If no user is found, throw an AuthenticationException
                throw new AuthenticationException();
            }
            
            
            
            
            // Logout the user by deleting the current access token
            $user->currentAccessToken()->delete();
    
            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully',
            ], 200); // Successful logout response
    
        } catch (AuthenticationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'You are not authenticated', // Custom message for unauthenticated users
            ], 401); // Returning 401 status code
        }
    }

    public function changePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', // Ensure you add a confirmation field
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'status' => false,
            'message' => 'The provided password does not match our records.',
        ], 400); // Return 400 Bad Request for incorrect password
    }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

      return response()->json([
    'status' => true,
    'message' => 'Password changed successfully.'
], 200);

    }
    
    
    public function getUserStatus(Request $request)
{
    // Retrieve the currently authenticated user
    $user = $request->user();

    // Return the user's name and status in JSON format
    return response()->json([
        'status' => true,
        'data' => [
            'name' => $user->name,
            'user_status' => $user->status
        ]
    ], 200);
}


public function totalTimeSpent(Request $request)
{
    $user = $request->user(); // get authenticated user

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'User not authenticated',
        ], 401);
    }

    $update = $request->input('update'); // manually entered total_time value

    // ✅ If update key is present → set total_time manually
    if ($update !== null) {
        if (!is_numeric($update) || $update < 0) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid time value',
            ], 422);
        }

        // Set total_time to the new manual value
        $user->total_time = $update;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Total time updated successfully',
            'total_time' => round($user->total_time, 2),
        ], 200);
    }

    // ✅ Otherwise, just fetch total time
    return response()->json([
        'status' => true,
        'message' => 'Fetched total time successfully',
        'total_time' => round($user->total_time ?? 0, 2),
    ], 200);
}



           
        
    
}
