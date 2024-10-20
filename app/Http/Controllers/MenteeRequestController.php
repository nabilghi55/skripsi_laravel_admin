<?php

namespace App\Http\Controllers;

use App\Models\MenteeRegistration;
use App\Models\MenteeRequest;
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
            'mentor_id' => 'required|exists:mentors,id',
        ]);

        $menteeId = auth()->user()->id; // Get the authenticated mentee's ID

        MenteeRequest::create([
            'mentee_id' => $menteeId,
            'mentor_id' => $request->mentor_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mentee request submitted successfully!',
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
