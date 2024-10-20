<x-app-layout>
<div class="min-h-screen bg-gray-100">

    <x-sidebar />

    <div class="mx-auto px-4 max-w-4xl py-8">
        <h1 class="text-3xl font-semibold mb-6 text-center">Edit Berita: {{ $berita->title }}</h1>



        <form action="{{ route('admin.berita.update', $berita->slug) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Title Input -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                <input type="text" name="title" id="title" value="{{ old('title', $berita->title) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" />
                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Uploaded By Input -->
            <div class="mb-4">
                <label for="uploaded_by" class="block text-sm font-medium text-gray-700">Diunggah Oleh</label>
                <input type="text" name="uploaded_by" id="uploaded_by" value="{{ old('uploaded_by', $berita->uploaded_by) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" />
                @error('uploaded_by')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Berita</label>
                @if($berita->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="w-1/4 h-auto rounded-lg shadow-lg">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" />
                @error('image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content Textarea -->
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Konten Berita</label>
                <textarea name="content" id="content" rows="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">{{ old('content', $berita->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan Perubahan</button>
            </div>
        </form>

        <div class="mt-6">
            <a href="{{ route('admin.berita.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Kembali ke Daftar Berita
            </a>
        </div>
    </div>

</div>
</x-app-layout>
