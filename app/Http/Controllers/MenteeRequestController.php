<?php

namespace App\Http\Controllers;

use App\Models\MenteeRegistration;
use App\Models\MenteeRequest;
use App\Models\MentoringRequest;
use Illuminate\Http\Request;

class MenteeRequestController extends Controller
{
    public function index()
    {
        $requests = MenteeRequest::with('mentee', 'mentor')->get();
        return view('admin.mentee.requests.index', compact('requests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required|exists:mentor,id',
        ]);
    
        $user = auth()->user();
        $mentee = $user->mentee;
        
        if ($user->role != 'mentee') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum terdaftar sebagai mentee.',
            ], 400);
        }
        
        if (is_null($mentee)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data mentee tidak ditemukan.',
            ], 400);
        }
    
        $existingRequest = MentoringRequest::where('mentee_id', $mentee->id)
                                        ->where('mentor_id', $request->mentor_id)
                                        ->where('status', 'pending')
                                        ->first();
    
        if ($existingRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah mengajukan permintaan mentoring ke mentor ini, tunggu sampai di-approve.',
            ], 400);
        }
    
        $mentoringRequest = MentoringRequest::create([
            'mentee_id' => $mentee->id,  // Gunakan ID untuk menyimpan
            'mentor_id' => $request->mentor_id,
            'status' => 'pending',
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Permintaan mentoring berhasil diajukan!',
            'data' => [
                'mentee_name' => $mentoringRequest->mentee->user->name,
                'mentor_name' => $mentoringRequest->mentor->user->name,
                'status' => $mentoringRequest->status, 
                ]
        ], 201);
        
    }
    
    
    
    

    public function approve($id)
    {
        $request = MenteeRequest::findOrFail($id);
        $request->is_approved = true;
        $request->save();

        return redirect()->route('admin.mentee.requests.index')->with('success', 'Mentee request approved!');
    }
    public function listAllMenteeRequests()
{
    // Mengambil semua mentee requests dari database
    $requests = MenteeRequest::with('mentor', 'mentee')->get(); // Memuat relasi mentor dan mentee jika ada

    // Kembalikan data dalam bentuk JSON
    return response()->json([
        'status' => 'success',
        'data' => $requests,
    ], 200);
}

    public function checkMentorApprovalStatus($id)
{
    $registration = MenteeRequest::findOrFail($id);

    // Kembalikan status apakah mentor sudah disetujui atau belum
    return response()->json([
        'status' => 'success',
        'is_approved' => $registration->is_approved, // true jika sudah di-approve, false jika belum
        'mentor' => $registration->mentor ? $registration->mentor->nama_mentor : null // Opsional: informasi mentor jika sudah disetujui
    ], 200);
}

}
