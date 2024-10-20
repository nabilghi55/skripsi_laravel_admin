<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 container">
            <div class="flex justify-between items-center mb-6"></div>

            <div class="rounded ml-40 overflow-hidden">
                <div class="flex justify-between mb-4">
                    <h1 class="text-3xl font-semibold">Daftar Acara</h1>
                    <a href="{{ route('admin.event.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Tambah Acara
                    </a>
                </div>

                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Judul</th>
                            <th class="py-3 px-6 text-left">Waktu</th>
                            <th class="py-3 px-6 text-left">Lokasi</th>
                            <th class="py-3 px-6 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td> <!-- Nomor Urut -->
                                <td class="py-3 px-6">{{ $event->title }}</td>
                                <td class="py-3 px-6">{{ $event->waktu }}</td>
                                <td class="py-3 px-6">{{ $event->lokasi }}</td>
                                <td class="py-3 px-6 flex space-x-2">
                                <a href="{{ route('admin.event.registrations', $event) }}" 
                                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Peserta
                                    </a>
                                    <a href="{{ route('admin.event.show', $event) }}" class="bg-green-400 text-white px-4 py-2 rounded hover:bg-green-500">
                                        Lihat
                                    </a>
                                    <a href="{{ route('admin.event.edit', $event) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.event.destroy', $event) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($events->isEmpty())
                            <tr>
                                <td colspan="5" class="py-3 px-6 text-center">Tidak ada acara yang ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
