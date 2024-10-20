<?php

namespace App\Http\Controllers;

use App\Models\MenteeRegistration;
use App\Models\MenteeRequest;
use App\Models\Mentor;
use App\Models\MentorRegistration;
use App\Models\User;
use Illuminate\Http\Request;

class MentorRegistrationController extends Controller
{
    public function index()
    {
        $registrations = MentorRegistration::all();

        return view('admin.mentor.registrations.index', compact('registrations'));
    }
    public function store(Request $request)
    {
        $user = auth()->user();
    
        if ($user->role === 'mentor') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah terdaftar sebagai mentor.',
            ], 400);
        }
    
        $request->validate([
            'keahlian' => 'required|string|max:255',
            'lulusan_tahun' => 'required|integer',
            'riwayat_pendidikan' => 'required|string',
            'pekerjaan_saat_ini' => 'required|string',
            'kontak_alumni' => 'required|string',
            'foto_alumni' => 'nullable|image|max:2048',
        ]);
    
        $data = $request->all();
        $data['email'] = $user->email; // Menambahkan email pengguna ke data
        $data['nama_mentor'] = $user->name;
        // Jika ada foto, simpan
        if ($request->hasFile('foto_alumni')) {
            $data['foto_alumni'] = $request->file('foto_alumni')->store('mentors', 'public');
        }
    
        // Buat pendaftaran mentor baru
        $registration = MentorRegistration::create($data);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran mentor berhasil!',
            'data' => $registration,
        ], 201);
    }
    
    
    public function show($id)
    {
        $mentor = Mentor::findOrFail($id); // Ambil mentor berdasarkan ID
    
        return view('admin.mentor.show', compact('mentor')); // Ganti dengan view yang sesuai
    }
    
    public function approve($id)
    {
        // Find the mentor registration
        $registration = MentorRegistration::findOrFail($id);
    
        // Check if the registration is already approved
        if ($registration->is_approved) {
            return response()->json([
                'status' => 'error',
                'message' => 'This mentor registration has already been approved.'
            ], 400);
        }
    
        // Create the mentor record, ensuring email is included
        $mentor = Mentor::create([
            'nama_mentor' => $registration->nama_mentor,
            'keahlian' => $registration->keahlian,
            'lulusan_tahun' => $registration->lulusan_tahun,
            'riwayat_pendidikan' => $registration->riwayat_pendidikan,
            'pekerjaan_saat_ini' => $registration->pekerjaan_saat_ini,
            'testimoni' => $registration->testimoni,
            'kontak_alumni' => $registration->kontak_alumni,
            'foto_alumni' => $registration->foto_alumni,
            'email' => $registration->email // Ensure email is fetched from the registration
        ]);
    
        // Find the user based on email
        $user = User::where('email', $registration->email)->first();
    
        if ($user) {
            $user->role = 'mentor'; // Change the user's role to mentor
            $user->save();
        }
    
        // Mark the registration as approved
        $registration->is_approved = true;
        $registration->save();
    
        return redirect()->route('admin.mentor.registrations.index')->with('success', 'Mentor registration approved!');
    }
    
    
    
    
    


    public function destroy($id)
    {
        $registration = MentorRegistration::findOrFail($id);
        $registration->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran mentor berhasil dihapus!',
        ]);
    }
    public function listMentors()
    {
        // Fetch all approved mentors
        $mentors = Mentor::whereHas('mentorRegistration', function($query) {
            $query->where('is_approved', true);
        })->get();
    
        return response()->json([
            'status' => 'success',
            'data' => $mentors,
        ], 200);
    }
    

public function showMentor($id)
{
    // Find mentor by ID
    $mentor = Mentor::findOrFail($id); // Fetch mentor by ID

    return response()->json([
        'status' => 'success',
        'data' => $mentor,
    ], 200);
}
public function listMenteeRequests($mentorId)
{
    // Ambil mentor berdasarkan ID
    $mentor = Mentor::findOrFail($mentorId);

    // Ambil semua request dari mentee yang terkait dengan mentor ini
    $requests = $mentor->menteeRequests()->with('mentee')->get(); // Mengambil relasi mentee

    return response()->json([
        'status' => 'success',
        'data' => $requests,
    ], 200);
}
public function listAllMenteeRequests()
{
    // Ambil semua mentee requests dari database
    $requests = MenteeRequest::with('mentor', 'mentee')->get(); // Memuat relasi mentor dan mentee jika ada

    return response()->json([
        'status' => 'success',
        'data' => $requests,
    ], 200);
}



    // Approve a mentee request
    public function approveMentee($id)
    {
        // Find the mentee registration
        $registration = MenteeRequest::findOrFail($id);

        // Update the registration as approved
        $registration->is_approved = true;
        $registration->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Mentee request approved!',
        ]);
    }

}
