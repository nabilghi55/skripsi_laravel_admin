<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar /> <!-- Menambahkan sidebar jika ada -->

        <div class="mx-auto px-4 container">
            <div class="rounded ml-40 overflow-hidden bg-white p-6">
                <h1 class="text-3xl font-semibold mb-6">{{ $mentor->nama_mentor }}</h1>
                <img src="{{ asset('storage/' . $mentor->foto_alumni) }}" alt="{{ $mentor->nama_mentor }}" class="mb-4 rounded w-1/3 h-auto">
                <p><strong>Lulusan Tahun:</strong> {{ $mentor->lulusan_tahun }}</p>
                <p><strong>Keahlian:</strong> {{ $mentor->keahlian }}</p>
                <p><strong>Riwayat Pendidikan:</strong> {{ $mentor->riwayat_pendidikan }}</p>
                <p><strong>Pekerjaan Saat Ini:</strong> {{ $mentor->pekerjaan_saat_ini }}</p>
                <p><strong>Kontak Alumni:</strong> {{ $mentor->kontak_alumni }}</p>
                <p><strong>Testimoni:</strong> {{ $mentor->testimoni }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
