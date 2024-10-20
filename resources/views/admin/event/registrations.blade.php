<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 container ">
            <div class="rounded ml-40 overflow-hidden pt-2">
                <h1 class="text-3xl font-semibold mb-4 mt-2">Pendaftar untuk {{ $event->title }}</h1>

                @if($registrations->isEmpty())
                    <p class="text-center mt-10">Belum ada pendaftar untuk acara ini.</p>
                @else
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-3 px-6 text-left">No</th>
                                <th class="py-3 px-6 text-left">Nama</th>
                                <th class="py-3 px-6 text-left">Angkatan</th>
                                <th class="py-3 px-6 text-left">Nomor HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $registration)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-6">{{ $registration->nama }}</td>
                                    <td class="py-3 px-6">{{ $registration->angkatan }}</td>
                                    <td class="py-3 px-6">{{ $registration->nomor_hp }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <a href="{{ route('admin.event.index') }}" 
                   class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Kembali ke Daftar Acara
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
