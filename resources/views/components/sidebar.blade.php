<div class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 bg-gray-900 text-white transition-transform transform md:translate-x-0 -translate-x-full h-screen" id="sidebar">
    <div class="p-6">
        <h2 class="text-2xl font-semibold">IKA SMADAJO</h2>
    </div>

    <nav class="flex-1 px-4 space-y-2">
        <a href="{{ route('dashboard') }}" 
           class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 
                  {{ request()->routeIs('dashboard') ? 'bg-blue-800' : '' }}">
            Dashboard
        </a>
        <a href="{{ url('admin/event') }}" 
           class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 
                  {{ request()->routeIs('admin.event.index') ? 'bg-blue-800' : '' }}">
             Event
        </a>
        <a href="{{ url('admin/berita') }}" 
           class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 
                  {{ request()->routeIs('admin.berita.index') ? 'bg-blue-800' : '' }}">
            Berita
        </a>
        <a href="{{ url('admin/lowongan') }}" 
           class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 
                  {{ request()->routeIs('admin.jobs.index') ? 'bg-blue-800' : '' }}">
            Lowongan
        </a>
        <a href="{{ url('admin/mentor/registrations') }}" 
           class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 
                  {{ request()->routeIs('admin.jobs.index') ? 'bg-blue-800' : '' }}">
            Daftar Mentor
        </a>
    
        <form method="POST" action="{{ route('logout') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700">
    @csrf
    <button type="submit" class="text-left w-full text-white">
        {{ __('Log Out') }}
    </button>
</form>

    </nav>

    <div class="p-4 text-center text-sm text-gray-400">
        &copy; {{ date('Y') }} IKA SMADAJO.
    </div>
</div>

<!-- Toggle button for mobile -->
<button id="sidebarToggle" class="absolute top-4 left-4 bg-blue-600 text-white p-2 rounded-md md:hidden z-50">
    ☰
</button>

<script>
    // JavaScript for toggling sidebar on mobile view
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        // Toggle the sidebar visibility
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
