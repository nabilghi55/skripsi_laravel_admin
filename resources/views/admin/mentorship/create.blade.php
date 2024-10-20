<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 container">
            <div class="rounded ml-40 overflow-hidden">
                <h1 class="text-3xl font-semibold mb-6">Tambah Mentor</h1>

                <form action="{{ route('admin.mentor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="nama_mentor" class="block text-sm font-medium text-gray-700">Nama Mentor</label>
                        <input type="text" name="nama_mentor" id="nama_mentor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="keahlian" class="block text-sm font-medium text-gray-700">Keahlian</label>
                        <input type="text" name="keahlian" id="keahlian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="lulusan_tahun" class="block text-sm font-medium text-gray-700">Lulusan Tahun</label>
                        <input type="number" name="lulusan_tahun" id="lulusan_tahun" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="riwayat_pendidikan" class="block text-sm font-medium text-gray-700">Riwayat Pendidikan</label>
                        <textarea name="riwayat_pendidikan" id="riwayat_pendidikan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="pekerjaan_saat_ini" class="block text-sm font-medium text-gray-700">Pekerjaan Saat Ini</label>
                        <input type="text" name="pekerjaan_saat_ini" id="pekerjaan_saat_ini" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="testimoni" class="block text-sm font-medium text-gray-700">Testimoni</label>
                        <textarea name="testimoni" id="testimoni" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="kontak_alumni" class="block text-sm font-medium text-gray-700">Kontak Alumni</label>
                        <input type="text" name="kontak_alumni" id="kontak_alumni" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="foto_alumni" class="block text-sm font-medium text-gray-700">Foto Alumni</label>
                        <input type="file" name="foto_alumni" id="foto_alumni" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                    </div>

                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan Mentor</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
