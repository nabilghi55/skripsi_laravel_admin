<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 container">
            <div class="rounded ml-40 overflow-hidden">
                <h1 class="text-3xl font-semibold mb-6">Pendaftaran Mentor</h1>

                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama Mentor</th>
                            <th class="py-3 px-6 text-left">Lulusan Tahun</th>
                            <th class="py-3 px-6 text-left">Keahlian</th>
                            <th class="py-3 px-6 text-left">Kontak Alumni</th>
                            <th class="py-3 px-6 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6"> <a href="{{ route('admin.mentor.show', $registration->id) }}" class="text-blue-600 hover:underline">
                                        {{ $registration->nama_mentor }}
                                    </a></td>
                                <td class="py-3 px-6">{{ $registration->lulusan_tahun }}</td>
                                <td class="py-3 px-6">{{ $registration->keahlian }}</td>
                                <td class="py-3 px-6">{{ $registration->kontak_alumni }}</td>
                                <td class="py-3 px-6">
                                    @if ($registration->is_approved)
                                    <div class="flex space-x-5 items-center">

                                        <span class="text-green-500 font-semibold">Approved</span>
                                        <form action="{{ route('admin.mentor.destroy', $registration->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
                                            </form>
                                            </div>
                                    @else
                                        <div class="flex space-x-2">
                                            <form action="{{ route('admin.mentor.approve', $registration->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Setujui</button>
                                            </form>
                                            <form action="{{ route('admin.mentor.destroy', $registration->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if ($registrations->isEmpty())
                            <tr>
                                <td colspan="6" class="py-3 px-6 text-center">Tidak ada pendaftaran mentor yang ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
