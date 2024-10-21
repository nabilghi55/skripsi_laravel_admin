<x-app-layout>
<div class="min-h-screen bg-gray-100">
    <x-sidebar />

    <div class="mx-auto px-4 container">
        <div class="flex justify-between items-center mb-6">
        </div>
        <div class="rounded ml-40 overflow-hidden">
            <div class="flex justify-between mb-4">
                <h1 class="text-3xl font-semibold">Daftar Berita</h1>
                <a href="{{ route('admin.berita.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Tambah Berita
                </a>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Judul</th>
                        <th class="py-3 px-6 text-left">Berita</th>
                        
                        <th class="py-3 px-6 text-left">Diunggah Oleh</th>
                        <th class="py-3 px-6 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beritas as $berita)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $loop->iteration }}</td> <!-- Nomor Urut -->
                            <td class="py-3 px-6">{{ $berita->title }}</td>
                            <td class="py-3 px-6">{{ Str::limit($berita->content, 100) }} <!-- Hanya menampilkan 100 karakter dari konten -->
                            </td>
                            <td class="py-3 px-6">{{ $berita->user->name ?? 'Tidak diketahui' }}</td>
                            <td class="py-3 px-6 flex space-x-2">
                                <a href="{{ route('admin.berita.show', $berita->slug) }}" class="bg-green-400 text-white px-4 py-2 rounded hover:bg-green-500">Lihat</a>
                                <a href="{{ route('admin.berita.edit', $berita->slug) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">edit</a>

                                <form action="{{ route('admin.berita.destroy', $berita->slug) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if ($beritas->isEmpty())
                        <tr>
                            <td colspan="4" class="py-3 px-6 text-center">Tidak ada berita yang ditemukan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
