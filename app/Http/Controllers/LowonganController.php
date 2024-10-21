<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Storage;
use Str;
use Auth;

class LowonganController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except(['getAllLowongan', 'getLowonganById', 'index', 'show']);
    }

    public function index()
    {
        $lowongans = JobVacancy::all();
        return view('admin.lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        return view('admin.lowongan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Validasi logo perusahaan
            'company_description' => 'nullable|string|max:1000', // Validasi deskripsi perusahaan
            'title' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'education' => 'required|string|max:255', // Ganti minimal_pendidikan dengan education
            'requirement' => 'required|string', // Ganti persyaratan dengan requirement
            'url' => 'required|url', // Ganti link_url dengan url
            'type' => 'required|string|in:wfo,wfh,hybrid', // Ganti tipe_kerja dengan type
            'location' => 'required|string|max:255',
        ]);
    
        $slug = Str::slug($validatedData['title']);
    
        $logoPath = null;
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('logos', 'public');
        }
    
        // Membuat lowongan baru dengan slug dan logo
        JobVacancy::create([
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
            'company_name' => $validatedData['company_name'],
            'company_logo' => $logoPath, // Simpan logo perusahaan
            'company_description' => $validatedData['company_description'], // Deskripsi perusahaan
            'title' => $validatedData['title'],
            'salary' => $validatedData['salary'],
            'education' => $validatedData['education'], // Pendidikan
            'requirement' => $validatedData['requirement'], // Persyaratan
            'url' => $validatedData['url'], // URL
            'type' => $validatedData['type'], // Tipe kerja
            'location' => $validatedData['location'], // Lokasi
            'slug' => $slug,
            'uploaded_at' => now(),
        ]);
    
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function show($slug)
    {
        $lowongan = JobVacancy::where('slug', $slug)->firstOrFail();
        return view('admin.lowongan.show', compact('lowongan'));
    }

    public function edit(JobVacancy $lowongan)
    {
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, JobVacancy $lowongan)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_description' => 'nullable|string|max:1000', // Deskripsi perusahaan
            'title' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'education' => 'required|string|max:255', // Pendidikan
            'requirement' => 'required|string', // Persyaratan
            'url' => 'required|url', // URL
            'type' => 'required|string|in:wfo,wfh,hybrid', // Tipe kerja
            'location' => 'required|string|max:255',
        ]);
    
        $slug = Str::slug($validatedData['title']);
    
        // Proses upload logo jika ada
        if ($request->hasFile('company_logo')) {
            // Hapus logo lama jika ada
            if ($lowongan->company_logo) {
                Storage::disk('public')->delete($lowongan->company_logo);
            }
    
            // Simpan logo baru
            $logoPath = $request->file('company_logo')->store('logos', 'public');
            $lowongan->company_logo = $logoPath;
        }
    
        // Update lowongan
        $lowongan->update([
            'company_name' => $validatedData['company_name'],
            'company_description' => $validatedData['company_description'], // Deskripsi perusahaan
            'title' => $validatedData['title'],
            'salary' => $validatedData['salary'],
            'education' => $validatedData['education'], // Pendidikan
            'requirement' => $validatedData['requirement'], // Persyaratan
            'url' => $validatedData['url'], // URL
            'type' => $validatedData['type'], // Tipe kerja
            'location' => $validatedData['location'],
            'slug' => $slug,
        ]);
    
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil diupdate.');
    }

    public function destroy(JobVacancy $lowongan)
    {
        $lowongan->delete();
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    public function getAllLowongan()
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Anda harus login untuk mengakses halaman ini.'
            ], 401);
        }
        $lowongans = JobVacancy::all();

        if ($lowongans->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada data lowongan tersedia',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Data lowongan berhasil diambil',
            'data' => $lowongans
        ], 200);
    }

    public function getLowonganById($id)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Anda harus login untuk mengakses halaman ini.'
            ], 401);
        }
        $lowongan = JobVacancy::find($id);

        if (!$lowongan) {
            return response()->json([
                'message' => 'Lowongan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail lowongan berhasil diambil',
            'data' => $lowongan
        ], 200);
    }
}
