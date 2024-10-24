<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 container">
            <div class="rounded ml-40 overflow-hidden">
                <h1 class="text-3xl font-semibold mb-6">Tambah Acara Baru</h1>

                <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Acara</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="waktu" class="block text-sm font-medium text-gray-700">Waktu Acara</label>
                        <input type="datetime-local" name="waktu" id="waktu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Acara</label>
                        <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Acara</label>
                        <input type="file" name="gambar" id="gambar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                    </div>

                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan Acara</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
