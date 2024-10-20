<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 container">
            <div class="rounded ml-40 overflow-hidden">
                <div class="flex justify-between mb-4">
                    <h1 class="text-3xl font-semibold">Daftar Mentor</h1>
                 
                </div>

                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama Mentor</th>
                            <th class="py-3 px-6 text-left">Keahlian</th>
                            <th class="py-3 px-6 text-left">Pekerjaan Saat Ini</th>
                            <th class="py-3 px-6 text-left">Foto</th>
                            <th class="py-3 px-6 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mentors as $mentor)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">{{ $mentor->nama_mentor }}</td>
                                <td class="py-3 px-6">{{ $mentor->keahlian }}</td>
                                <td class="py-3 px-6">{{ $mentor->pekerjaan_saat_ini }}</td>
                                <td class="py-3 px-6">
                                    @if($mentor->foto_alumni)
                                        <img src="{{ asset('storage/' . $mentor->foto_alumni) }}" alt="{{ $mentor->nama_mentor }}" width="50">
                                    @endif
                                </td>
                                <td class="py-3 px-6 flex space-x-2">
                                    <a href="{{ route('admin.mentorship.show', $mentor) }}" class="bg-green-400 text-white px-4 py-2 rounded hover:bg-green-500">Lihat</a>
                                    <a href="{{ route('admin.mentorship.edit', $mentor) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Edit</a>
                                    <form action="{{ route('admin.mentorship.destroy', $mentor) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($mentors->isEmpty())
                            <tr>
                                <td colspan="6" class="py-3 px-6 text-center">Belum ada mentor yang terdaftar.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
