<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 container">
            <div class="rounded ml-40 overflow-hidden">
                <h1 class="text-3xl font-semibold mb-6">Edit Acara</h1>

                <form action="{{ route('admin.event.update', $event) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Acara</label>
                        <input type="text" name="title" id="title" value="{{ $event->title }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="waktu" class="block text-sm font-medium text-gray-700">Waktu Acara</label>
                        <input type="datetime-local" name="waktu" id="waktu" value="{{ $event->date->format('Y-m-d\TH:i') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ $event->location }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Acara</label>
                        <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">{{ $event->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Acara</label>
                        <input type="file" name="gambar" id="gambar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                        @if ($event->images)
                            <img src="{{ asset('storage/' . $event->images) }}" alt="Gambar Acara" class="w-1/2 max-w-xs mt-2">
                        @endif
                    </div>

                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Perbarui Acara</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
