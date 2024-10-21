<?php
namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\News;
use Auth;
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
        $beritas = News::all();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|string',
        ]);
    
        $slug = Str::slug($validatedData['title']);
    
        $path = $request->file('image')->store('images', 'public');
    
        News::create([
            'title' => $validatedData['title'],
            'user_id' => Auth::id(), 
            'images' => $path,
            'content' => $validatedData['content'],
            'slug' => $slug,
        ]);
    
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dibuat!');
    }
    
    
    

    public function show($slug)
    {
        $News = News::where('slug', $slug)->firstOrFail();
        return view('admin.News.show', compact('News'));
        
    }

    public function edit(News $News)
    {
        return view('admin.News.edit', compact('News'));
        
    }

    public function update(Request $request, News $News)
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
            if ($News->image) {
                Storage::disk('public')->delete($News->image);
            }
    
            // Upload gambar baru dan dapatkan path-nya
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }
    
        // Update data News
        $News->update($data);
    
        // Redirect kembali ke daftar News dengan pesan sukses
        return redirect()->route('admin.News.index')->with('success', 'News berhasil diupdate.');
    }

    

    public function destroy(News $news)
    {
        if ($news->images) {
            Storage::disk('public')->delete($news->images);
        }

        $news->delete();
        return redirect()->route('admin.berita.index');
    }

    public function getAll()
    {
        $Newss = News::all();
    
        if ($Newss->isEmpty()) {
            return response()->json([
                'message' => 'News tidak tersedia',
                'data' => []
            ], 404);
        }
    
        $Newss->transform(function ($News) {
            $News->image = url('storage/' . $News->image); // Assuming images are stored in the 'storage' folder
            return $News;
        });
    
        return response()->json([
            'message' => 'News berhasil diambil',
            'data' => $Newss
        ], 200);
    }
    
    
    public function getSingleBySlug($slug)
{
    if (!auth()->check()) {
        return response()->json([
            'message' => 'Anda harus login untuk mengakses halaman ini.'
        ], 401);
    }

    $News = News::where('slug', $slug)->first();

    if (!$News) {
        return response()->json([
            'message' => 'News tidak ditemukan',
        ], 404);
    }

    return response()->json([
        'message' => 'News berhasil diambil',
        'data' => $News
    ], 200);
}

}

