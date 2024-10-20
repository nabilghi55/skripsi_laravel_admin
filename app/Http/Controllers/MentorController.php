<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    /**
     * Display a listing of the mentors.
     */
    public function index()
    {
        $mentors = Mentor::all();
        return view('admin.mentorship.index', compact('mentors'));
    }

    /**
     * Show the form for creating a new mentor.
     */
    public function create()
    {
        return view('admin.mentorship.create');
    }

    /**
     * Store a newly created mentor in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mentor' => 'required',
            'keahlian' => 'required',
            'lulusan_tahun' => 'required|integer',
            'riwayat_pendidikan' => 'required',
            'pekerjaan_saat_ini' => 'required',
            'kontak_alumni' => 'required',
            'foto_alumni' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_alumni')) {
            $data['foto_alumni'] = $request->file('foto_alumni')->store('mentors', 'public');
        }

        Mentor::create($data);

        return redirect()->route('admin.mentorship.index')->with('success', 'Mentor berhasil ditambahkan!');
    }

    /**
     * Display the specified mentor.
     */
    public function show($id)
    {
        $mentor = Mentor::findOrFail($id); // Ambil mentor berdasarkan ID
    
        return view('admin.mentor.registrations.show', compact('mentor')); // Ganti dengan view yang sesuai
    }

    /**
     * Show the form for editing the specified mentor.
     */
    public function edit(Mentor $mentor)
    {
        return view('admin.mentorship.edit', compact('mentor'));
    }

    /**
     * Update the specified mentor in storage.
     */
    public function update(Request $request, Mentor $mentor)
    {
        $request->validate([
            'nama_mentor' => 'required',
            'keahlian' => 'required',
            'lulusan_tahun' => 'required|integer',
            'riwayat_pendidikan' => 'required',
            'pekerjaan_saat_ini' => 'required',
            'kontak_alumni' => 'required',
            'foto_alumni' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_alumni')) {
            if ($mentor->foto_alumni && \Storage::exists('public/' . $mentor->foto_alumni)) {
                \Storage::delete('public/' . $mentor->foto_alumni);
            }
            $data['foto_alumni'] = $request->file('foto_alumni')->store('mentors', 'public');
        }

        $mentor->update($data);

        return redirect()->route('admin.mentorship.index')->with('success', 'Mentor berhasil diperbarui!');
    }

    /**
     * Remove the specified mentor from storage.
     */
    public function destroy(Mentor $mentor)
    {
        if ($mentor->foto_alumni && \Storage::exists('public/' . $mentor->foto_alumni)) {
            \Storage::delete('public/' . $mentor->foto_alumni);
        }

        $mentor->delete();

        return redirect()->route('admin.mentor.index')->with('success', 'Mentor berhasil dihapus!');
    }
}
