<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 max-w-4xl py-8">
            <h1 class="text-3xl font-semibold mb-6 text-center">Tambah Lowongan Pekerjaan</h1>

            <form action="{{ route('admin.lowongan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Company Name Input -->
                <div class="mb-4">
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                    <input type="text" name="company_name" id="company_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Company Logo Input -->
                <div class="mb-4">
                    <label for="company_logo" class="block text-sm font-medium text-gray-700">Logo Perusahaan</label>
                    <input type="file" name="company_logo" id="company_logo" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <!-- Title Input -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Lowongan</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Salary Input -->
                <div class="mb-4">
                    <label for="salary" class="block text-sm font-medium text-gray-700">Gaji (Opsional)</label>
                    <input type="text" name="salary" id="salary" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Minimal Pendidikan Input -->
                <div class="mb-4">
                    <label for="minimal_pendidikan" class="block text-sm font-medium text-gray-700">Minimal Pendidikan</label>
                    <input type="text" name="minimal_pendidikan" id="minimal_pendidikan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Persyaratan Input -->
                <div class="mb-4">
                    <label for="persyaratan" class="block text-sm font-medium text-gray-700">Persyaratan</label>
                    <textarea name="persyaratan" id="persyaratan" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>

                <!-- Link URL Input -->
                <div class="mb-4">
                    <label for="link_url" class="block text-sm font-medium text-gray-700">Link Pendaftaran</label>
                    <input type="url" name="link_url" id="link_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Tipe Kerja Input -->
                <div class="mb-4">
                    <label for="tipe_kerja" class="block text-sm font-medium text-gray-700">Tipe Kerja</label>
                    <select name="tipe_kerja" id="tipe_kerja" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="wfo">WFO</option>
                        <option value="wfh">WFH</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>

                <!-- Lokasi Input -->
                <div class="mb-4">
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Tambah Lowongan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
