<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use Storage;
use Str;

class LowonganController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except(['getAllLowongan', 'getLowonganById', 'index', 'show']);;
    }

    public function index()
    {
        $lowongans = Lowongan::all();
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
            'title' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'minimal_pendidikan' => 'required|string|max:255',
            'persyaratan' => 'required|string',
            'link_url' => 'required|url',
            'tipe_kerja' => 'required|string|in:wfo,wfh,hybrid',
            'lokasi' => 'required|string|max:255',
        ]);
    
        $slug = Str::slug($validatedData['title']);
    
        $logoPath = null;
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('logos', 'public');
        }
    
        // Membuat lowongan baru dengan slug dan logo
        Lowongan::create([
            'company_name' => $request->input('company_name'),
            'company_logo' => $logoPath, // Simpan logo perusahaan
            'title' => $request->input('title'),
            'salary' => $request->input('salary'),
            'minimal_pendidikan' => $request->input('minimal_pendidikan'),
            'persyaratan' => $request->input('persyaratan'),
            'link_url' => $request->input('link_url'),
            'tipe_kerja' => $request->input('tipe_kerja'),
            'lokasi' => $request->input('lokasi'),
            'slug' => $slug,
            'uploaded_at' => now(),
        ]);
    
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }
    
    

    public function show($slug)
    {
        $lowongan = Lowongan::where('slug', $slug)->firstOrFail();
        return view('admin.lowongan.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk logo
            'title' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'minimal_pendidikan' => 'required|string|max:255',
            'persyaratan' => 'required|string',
            'link_url' => 'required|url',
            'tipe_kerja' => 'required|string|in:wfo,wfh,hybrid',
            'lokasi' => 'required|string|max:255',
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
            'title' => $validatedData['title'],
            'salary' => $validatedData['salary'],
            'minimal_pendidikan' => $validatedData['minimal_pendidikan'],
            'persyaratan' => $validatedData['persyaratan'],
            'link_url' => $validatedData['link_url'],
            'tipe_kerja' => $validatedData['tipe_kerja'],
            'lokasi' => $validatedData['lokasi'],
            'slug' => $slug,
        ]);
    
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil diupdate.');
    }
    

    public function destroy(Lowongan $lowongan)
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
        $lowongans = Lowongan::all();

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

    // Method untuk API - Mengambil detail lowongan berdasarkan ID
    public function getLowonganById($id)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Anda harus login untuk mengakses halaman ini.'
            ], 401);
        }
        $lowongan = Lowongan::find($id);

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
