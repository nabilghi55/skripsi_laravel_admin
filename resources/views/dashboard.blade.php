<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Include Sidebar Template -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-8 ml-64">
            <h1 class="text-3xl font-bold mb-6">Selamat Datang di Dashboard Admin</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Total Berita</h3>
                    <p>{{ $totalBerita }} Berita</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Total Event</h3>
                    <p>{{ $totalEvent }} Event</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Total Mentor</h3>
                    <p>{{ $totalMentor }} Mentor</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Total Lowongan Kerja</h3>
                    <p>{{ $totalLowongan }} Lowongan</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Total Alumni Terdaftar</h3>
                    <p>{{ $totalAlumni }} Alumni</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-4">Total Alumni Mentor </h3>
                    <p>{{ $totalMentor }} Mentor</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
