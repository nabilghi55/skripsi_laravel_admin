<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use App\Models\MenteeRegistration;
use App\Models\MenteeRequest;
use App\Models\Mentor;
use App\Models\MentoringRequest;
use App\Models\MentorRegistration;
use App\Models\User;
use Illuminate\Http\Request;

class MentorRegistrationController extends Controller
{
    public function index()
    {
        $registrations = Mentor::all();

        return view('admin.mentor.registrations.index', compact('registrations'));
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $existingMentor = Mentor::where('user_id', $user->id)->first();

      
        if ($user->role === 'mentor') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah terdaftar sebagai mentor.',
            ], 400);
        }
    
        $request->validate([
            'expertise' => 'required|string|max:255',
            'education' => 'required|string',
            'current_job' => 'required|string',
            'portfolio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);
    
        $data = $request->except('photo');
        if ($existingMentor && $data['status'] ==="pending") {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah mengajukan menjadi mentor, tunggu sampai di-approve oleh admin.',
            ], 400);
        }
        $data['user_id'] = $user->id;
        $data['status'] = 'pending'; 
    
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('mentors', 'public');
    
            $data['photo'] = url('storage/' . $path);
        }
    
        $mentor = Mentor::create($data);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran mentor berhasil!',
            'data' => $mentor,
        ], 201);
    }
    
    public function show($id)
    {
        $mentor = Mentor::findOrFail($id);
    
        return view('admin.mentor.show', compact('mentor')); // Ganti dengan view yang sesuai
    }
    
    public function approve($id)
    {
        // Cari pendaftaran mentor berdasarkan ID
        $registration = Mentor::findOrFail($id);
    
        // Cek apakah sudah di-approve sebelumnya
        if ($registration->is_approved) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pendaftaran mentor ini sudah di-approve.'
            ], 400);
        }
    
        // Update role user menjadi 'mentor'
        $user = User::where('id', $registration->user_id)->first();
    
        if ($user) {
            $user->role = 'mentor';
            $user->save();
        }
    
        $registration->status = 'approved'; 
        $registration->save();
    
        return redirect()->route('admin.mentor.registrations.index')->with('success', 'Pendaftaran mentor berhasil di-approve!');
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
        $mentors = Mentor::with('user') // Mengambil relasi user untuk mendapatkan nama
                          ->where('status', 'approved') // Filter status approved
                          ->get();
    
        $mentors = $mentors->map(function ($mentor) {
            return [
                'id' => $mentor->id,
                'user_id' => $mentor->user_id,
                'name' => $mentor->user->name, 
                'angkatan' => $mentor->user->graduation ?? 'Tidak tersedia', 
                'photo' => $mentor->photo,
                'portfolio' => $mentor->portfolio,
                'current_job' => $mentor->current_job,
                'education' => $mentor->education,
                'status' => $mentor->status,
                'expertise' => $mentor->expertise,
                'created_at' => $mentor->created_at,
                'updated_at' => $mentor->updated_at,
            ];
        });
    
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil Mendapatkan data mentor',
            'data' => $mentors,
        ], 200);
    }
    
    

    public function showMentor($id)
    {
        $mentor = Mentor::with('user') 
                        ->findOrFail($id); 
    
        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $mentor->id,
                'user_id' => $mentor->user_id,
                'photo' => $mentor->photo,
                'portfolio' => $mentor->portfolio,
                'current_job' => $mentor->current_job,
                'education' => $mentor->education,
                'status' => $mentor->status,
                'expertise' => $mentor->expertise,
                'nama' => $mentor->user->name, // Mengambil nama dari relasi user
                'angkatan' => $mentor->user->graduation ?? 'Tidak tersedia', // Mengambil angkatan jika ada, jika tidak tampilkan default
                'created_at' => $mentor->created_at,
                'updated_at' => $mentor->updated_at,
            ],
        ], 200);
    }
    
    public function listMenteeRequests($requestId)
{
    $request = MentoringRequest::with(['mentor', 'mentee'])->findOrFail($requestId); // Memastikan permintaan ada

    return response()->json([
        'status' => 'success',
        'data' => [
            'id' => $request->id,
            'mentee'=>[
                'nama_mentee' => $request->mentee->user->name, 
                'nomor_hp_menteee'=>$request->mentee->user->phone,
                'angkatan_mentee'=>$request->mentee->user->graduation,
                'pertanyaan_mentee'=>$request->mentee->question,
            ],
            'mentor_name' => $request->mentor->user->name, 
            'status' => $request->status ,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ],
       
    ], 200);
}
public function listAllMenteeRequests()
{
    $requests = MentoringRequest::with(['mentor', 'mentee'])->get();

    $formattedRequests = $requests->map(function ($request) {
        return [
            'id' => $request->id,
            'mentee_name' => $request->mentee->user->name, 
            'mentor_name' => $request->mentor->user->name, 
            'status' => $request->status ,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ];
    });
    return response()->json([
        'status' => 'success',
        'data' => $formattedRequests,
    ], 200);
}
public function approveMentee($id)
{
    $request = MentoringRequest::findOrFail($id);
    if ($request->status === 'approved') {
        return response()->json([
            'status' => 'error',
            'message' => 'Permintaan mentee ini sudah di-approve sebelumnya.',
        ], 400);
    }
    $request->status = 'approved';
    $request->save();
    return response()->json([
        'status' => 'success',
        'message' => 'Permintaan mentee berhasil disetujui!',
        'data' => [
            'mentee_id' => $request->mentee_id,
            'mentor_id' => $request->mentor_id,
            'status' => $request->status, 
        ],
    ], 200);
}

}
