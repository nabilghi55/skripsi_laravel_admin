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

                <!-- Company Description Input -->
                <div class="mb-4">
                    <label for="company_description" class="block text-sm font-medium text-gray-700">Deskripsi Perusahaan</label>
                    <textarea name="company_description" id="company_description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
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

                <!-- Minimal Pendidikan Input (Changed to 'Education') -->
                <div class="mb-4">
                    <label for="education" class="block text-sm font-medium text-gray-700">Minimal Pendidikan</label>
                    <input type="text" name="education" id="education" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Persyaratan Input (Changed to 'Requirement') -->
                <div class="mb-4">
                    <label for="requirement" class="block text-sm font-medium text-gray-700">Persyaratan</label>
                    <textarea name="requirement" id="requirement" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>

                <!-- Link URL Input (Changed to 'URL') -->
                <div class="mb-4">
                    <label for="url" class="block text-sm font-medium text-gray-700">Link Pendaftaran</label>
                    <input type="url" name="url" id="url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Tipe Kerja Input (Changed to 'Type') -->
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipe Kerja</label>
                    <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="wfo">WFO</option>
                        <option value="wfh">WFH</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>

                <!-- Lokasi Input -->
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="location" id="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
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
