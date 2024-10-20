<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <x-sidebar />

        <div class="mx-auto px-4 max-w-4xl py-8">
            <h1 class="text-3xl font-semibold mb-6 text-center">Edit Lowongan: {{ $lowongan->title }}</h1>

            <form action="{{ route('admin.lowongan.update', $lowongan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Lowongan</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $lowongan->title }}" required>
                </div>
                <div class="mb-4">
    <label for="company_name" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
    <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $lowongan->company_name ?? '') }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
</div>

                <!-- Salary Input -->
                <div class="mb-4">
                    <label for="salary" class="block text-sm font-medium text-gray-700">Gaji (Opsional)</label>
                    <input type="text" name="salary" id="salary" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $lowongan->salary }}">
                </div>

                <!-- Minimal Pendidikan Input -->
                <div class="mb-4">
                    <label for="minimal_pendidikan" class="block text-sm font-medium text-gray-700">Minimal Pendidikan</label>
                    <input type="text" name="minimal_pendidikan" id="minimal_pendidikan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $lowongan->minimal_pendidikan }}" required>
                </div>

                <!-- Persyaratan Input -->
                <div class="mb-4">
                    <label for="persyaratan" class="block text-sm font-medium text-gray-700">Persyaratan</label>
                    <textarea name="persyaratan" id="persyaratan" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ $lowongan->persyaratan }}</textarea>
                </div>

                <!-- Link URL Input -->
                <div class="mb-4">
                    <label for="link_url" class="block text-sm font-medium text-gray-700">Link Pendaftaran</label>
                    <input type="url" name="link_url" id="link_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $lowongan->link_url }}" required>
                </div>

                <!-- Tipe Kerja Input -->
                <div class="mb-4">
                    <label for="tipe_kerja" class="block text-sm font-medium text-gray-700">Tipe Kerja</label>
                    <select name="tipe_kerja" id="tipe_kerja" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="wfo" {{ $lowongan->tipe_kerja == 'wfo' ? 'selected' : '' }}>WFO</option>
                        <option value="wfh" {{ $lowongan->tipe_kerja == 'wfh' ? 'selected' : '' }}>WFH</option>
                        <option value="hybrid" {{ $lowongan->tipe_kerja == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                </div>

                <!-- Lokasi Input -->
                <div class="mb-4">
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $lowongan->lokasi }}" required>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update Lowongan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
