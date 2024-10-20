<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class=" mx-auto px-4 container">
            <div class="flex justify-between items-center mb-6">
               
            </div>
            <div class="rounded ml-40 overflow-hidden">
            <div class="flex justify-between mb-4">
                <h1 class="text-3xl font-semibold">Daftar Lowongan Pekerjaan</h1>
                <a href="{{ route('admin.lowongan.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Tambah Lowongan
                </a>
            </div>
            <table class="min-w-full  bg-white">
                <thead>
                    <tr class="bg-gray-200">
                    <th class="py-3 px-6 text-left">No</th>

                        <th class="py-3 px-6 text-left">Pekerjaan</th>
                        <th class="py-3 px-6 text-left">Nama Perusahaan</th>
                        <th class="py-3 px-6 text-left">Logo Perusahaan</th>

                        <th class="py-3 px-6 text-left">Gaji</th>
                        <th class="py-3 px-6 text-left">Lokasi</th>
                        <th class="py-3 px-6 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowongans as $lowongan)
                        <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $loop->iteration }}</td> <!-- Nomor Urut -->

                            <td class="py-3 px-6">{{ $lowongan->title }}</td>
                            <td class="py-3 px-6">{{ $lowongan->company_name }}</td>
                            <td>
        @if($lowongan->company_logo)
            <img src="{{ asset('storage/' . $lowongan->company_logo) }}" alt="Logo {{ $lowongan->company_name }}" width="50">
        @endif
    </td>
                            <td class="py-3 px-6">{{ $lowongan->salary ?? 'Tidak disebutkan' }}</td>
                            <td class="py-3 px-6">{{ $lowongan->lokasi }}</td>
                            <td class="py-3 px-6 flex space-x-2">
                                <a href="{{ route('admin.lowongan.edit', $lowongan->id) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Edit</a>
                                <form action="{{ route('admin.lowongan.destroy', $lowongan->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if ($lowongans->isEmpty())
                        <tr>
                            <td colspan="4" class="py-3 px-6 text-center">Tidak ada lowongan pekerjaan yang ditemukan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        </div>
    </div>
</x-app-layout>
