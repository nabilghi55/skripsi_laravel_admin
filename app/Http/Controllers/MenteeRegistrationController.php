<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mentee;
use App\Models\MenteeRegistration;
use Auth;
use Illuminate\Http\Request;

class MenteeRegistrationController extends Controller
{
    public function index()
    {
        $registrations = Mentee::all();
        return view('admin.mentee.registrations.index', compact('registrations'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
        ]);
    
        $user = Auth::user();
    
        if ($user->role === 'mentee') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah terdaftar sebagai mentee.',
            ], 400);
        }
    
        if (Mentee::where('user_id', $user->id)->where('status', 'pending')->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda memiliki pendaftaran mentee yang belum disetujui.',
            ], 400);
        }
    
        $mentee = Mentee::create([
            'user_id' => $user->id,
            'status' => 'pending', 
            'question' => $request->question, 
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran mentee berhasil!',
            'data' => $mentee,
        ], 201);
    }
    
    

    public function approve($id)
    {
        $registration = Mentee::findOrFail($id);
        $user = $registration->user; // Get the user associated with the registration

        $user->role = 'mentee';
        $user->save();

        $registration->status = 'approved';
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
