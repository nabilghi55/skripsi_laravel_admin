<x-app-layout>
    <div class="min-h-screen">

        <x-sidebar />

        <div class="container mx-auto px-4 bg-white">

            <form class="ml-40 mt-4" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                <h1 class="text-3xl font-semibold mb-6">Tambah Berita</h1>

                @csrf
                <div class="bg-white shadow-md rounded my-6 p-6">
                    
                    <!-- Tampilkan error untuk validasi -->
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada beberapa masalah dengan inputan Anda.</span>
                            <ul class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Input Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" />
                        @error('title')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Gambar -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                        <input type="file" name="image" id="image" accept="image/*" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" />
                        @error('image')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Konten -->
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
                        <textarea name="content" id="content" rows="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
