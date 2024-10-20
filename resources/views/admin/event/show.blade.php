<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 container">
            <div class="rounded ml-40 overflow-hidden">
                <h1 class="text-3xl font-semibold mb-4">{{ $event->title }}</h1>

                <p class="text-lg mb-2"><strong>Waktu:</strong> {{ $event->waktu }}</p>
                <p class="text-lg mb-2"><strong>Lokasi:</strong> {{ $event->lokasi }}</p>
                <p class="text-lg mb-4"><strong>Deskripsi:</strong> {{ $event->deskripsi }}</p>

                @if ($event->gambar)
                    <img src="{{ asset('storage/' . $event->gambar) }}" alt="Gambar Acara" class="w-full max-w-lg mb-4">
                @endif

                <a href="{{ route('admin.event.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali ke Daftar Acara</a>
            </div>
        </div>
    </div>
</x-app-layout>
