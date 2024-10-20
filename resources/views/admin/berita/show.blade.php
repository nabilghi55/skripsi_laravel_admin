<x-app-layout>
<div class="min-h-screen bg-gray-100">

    <x-sidebar />

    <div class="mx-auto px-4 max-w-4xl py-8"> <!-- Pembatas lebar konten agar tidak nabrak -->
 
        <h1 class="text-3xl font-semibold mb-6 text-center">{{ $berita->title }}</h1> <!-- Buat judul di tengah -->

        <p class="text-gray-700 mb-4 text-center">Diunggah oleh: {{ $berita->uploaded_by }}</p> <!-- Informasi pengunggah di tengah -->

        @if ($berita->image)
        <div class="mb-6 flex justify-center"> <!-- Gambar di tengah -->
            <img src="{{ asset('storage/' . $berita->image) }}" alt="{{ $berita->title }}" class="w-1/2 h-auto rounded-lg shadow-lg"> <!-- Gambar lebih kecil dan ada shadow -->
        </div>
        @endif

        <div class="text-gray-800 text-justify leading-relaxed"> <!-- Konten berita dengan text align justify -->
            {!! nl2br(e($berita->content)) !!}
        </div>

        
    </div>

</div>
</x-app-layout>
