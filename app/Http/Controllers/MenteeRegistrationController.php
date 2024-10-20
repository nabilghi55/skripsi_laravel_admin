<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MenteeRegistration;
use Auth;
use Illuminate\Http\Request;

class MenteeRegistrationController extends Controller
{
    // View all mentee registrations
    public function index()
    {
        $registrations = MenteeRegistration::with('user', 'mentor')->get(); // Fetch registrations with user and mentor details
        return view('admin.mentee.registrations.index', compact('registrations'));
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'angkatan' => 'required|string|max:50',
            'hal_yang_ingin_ditanyakan' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Check if the user is already a mentee or has a pending registration
        if ($user->role === 'mentee') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah terdaftar sebagai mentee.',
            ], 400);
        }
    
        // Check if the user has any pending mentee registrations
        if (MenteeRegistration::where('user_id', $user->id)->where('is_approved', false)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda memiliki pendaftaran mentee yang belum disetujui.',
            ], 400);
        }
    
        // Proceed with the registration
        $registration = MenteeRegistration::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'nama' => $user->name,
            'mentor_id' => null, // Set mentor_id to null initially
            'angkatan' => $request->angkatan,
            'hal_yang_ingin_ditanyakan' => $request->hal_yang_ingin_ditanyakan,
            'nomor_hp' => $request->nomor_hp,
            'is_approved' => false, // Default to false until approved by admin
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran mentee berhasil!',
            'data' => $registration,
        ], 201);
    }
    

    // Approve mentee registration
    public function approve($id)
    {
        $registration = MenteeRegistration::findOrFail($id);
        $user = $registration->user; // Get the user associated with the registration

        // Update the user's role to mentee
        $user->role = 'mentee';
        $user->save();

        // Mark the registration as approved
        $registration->is_approved = true;
        $registration->save();

        return redirect()->route('admin.mentee.registrations.index')->with('success', 'Mentee registration approved!');
    }
    public function destroy($id)
    {
        $registration = MenteeRegistration::findOrFail($id);
        $registration->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran mentee berhasil dihapus!',
        ]);
    }
}
