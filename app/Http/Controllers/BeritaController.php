<?php
namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except(['getAll', 'getSingleBySlug', 'index', 'show']);
    }

    public function index()
    {
        $beritas = Berita::all();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }


    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'uploaded_by' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|string',
        ]);
    
        $slug = Str::slug($validatedData['title']);
    
        $path = $request->file('image')->store('images', 'public');
    
        // Membuat berita baru dengan slug
        Berita::create([
            'title' => $validatedData['title'],
            'uploaded_by' => $validatedData['uploaded_by'],
            'image' => $path,
            'content' => $validatedData['content'],
            'slug' => $slug,  // Pastikan slug diisi
        ]);
    
        return redirect()->route('admin.berita.index');
    }
    
    

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('admin.berita.show', compact('berita'));
        
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
        
    }

    public function update(Request $request, Berita $berita)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'uploaded_by' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|string',
        ]);
    
        // Perbarui slug jika title berubah
        $data = [
            'title' => $request->input('title'),
            'uploaded_by' => $request->input('uploaded_by'),
            'content' => $request->input('content'),
            'slug' => Str::slug($request->input('title')), // Update slug dari judul
        ];
    
        // Proses file gambar jika ada yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($berita->image) {
                Storage::disk('public')->delete($berita->image);
            }
    
            // Upload gambar baru dan dapatkan path-nya
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }
    
        // Update data berita
        $berita->update($data);
    
        // Redirect kembali ke daftar berita dengan pesan sukses
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate.');
    }

    

    public function destroy(Berita $berita)
    {
        // Hapus gambar dari storage jika ada
        if ($berita->image) {
            Storage::disk('public')->delete($berita->image);
        }

        $berita->delete();
        return redirect()->route('admin.berita.index');
    }

    // API Method (Tanpa Middleware untuk akses umum)
    public function getAll()
    {
        $beritas = Berita::all();
    
        if ($beritas->isEmpty()) {
            return response()->json([
                'message' => 'Berita tidak tersedia',
                'data' => []
            ], 404);
        }
    
        // Add full URL to the image field
        $beritas->transform(function ($berita) {
            $berita->image = url('storage/' . $berita->image); // Assuming images are stored in the 'storage' folder
            return $berita;
        });
    
        return response()->json([
            'message' => 'Berita berhasil diambil',
            'data' => $beritas
        ], 200);
    }
    
    
    public function getSingleBySlug($slug)
{
    if (!auth()->check()) {
        return response()->json([
            'message' => 'Anda harus login untuk mengakses halaman ini.'
        ], 401);
    }

    $berita = Berita::where('slug', $slug)->first();

    if (!$berita) {
        return response()->json([
            'message' => 'Berita tidak ditemukan',
        ], 404);
    }

    return response()->json([
        'message' => 'Berita berhasil diambil',
        'data' => $berita
    ], 200);
}

}

