<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MenteeRegistration;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenteeController extends Controller
{
    // Fetch all available mentors
    public function index()
    {
        $mentors = Mentor::all();
        return response()->json($mentors);
    }

    // Register as a mentee (store registration)
    public function register(Request $request, $mentorId)
    {
        $user = Auth::user();

        // Check if the user is already a mentee
        if ($user->role === 'mentee') {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already registered as a mentee.'
            ], 400);
        }

        // Create a mentee registration record
        MenteeRegistration::create([
            'user_id' => $user->id,
            'mentor_id' => $mentorId,
            'is_approved' => false, // Default to not approved
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully registered as a mentee! Waiting for approval.'
        ], 201);
    }
}
