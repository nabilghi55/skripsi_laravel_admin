<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 container">
            <div class="rounded ml-40 overflow-hidden">
                <h1 class="text-3xl font-semibold mb-6">Pendaftaran Mentee</h1>

                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Angkatan</th>
                            <th class="py-3 px-6 text-left">Hal yang Ingin Ditanyakan</th>
                            <th class="py-3 px-6 text-left">Nomor HP</th>
                            <th class="py-3 px-6 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                <td class="py-3 px-6">{{ $registration->user->name }}</td>
                                <td class="py-3 px-6">{{ $registration->user->email }}</td>
                                <td class="py-3 px-6">{{ $registration->user->graduation }}</td>
                                <td class="py-3 px-6">{{ $registration->question }}</td>
                                <td class="py-3 px-6">{{ $registration->user->phone }}</td>
                                <td class="py-3 px-6 flex space-x-2">
                                @if ($registration->status === 'approved')
                                        <span class="text-green-500 font-semibold">Approved</span>
                                    @else
                                        <form action="{{ route('admin.mentee.approve', $registration->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Setujui</button>
                                        </form>
                                        <form action="{{ route('admin.mentee.destroy', $registration->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if ($registrations->isEmpty())
                            <tr>
                                <td colspan="7" class="py-3 px-6 text-center">Tidak ada pendaftaran mentee yang ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
