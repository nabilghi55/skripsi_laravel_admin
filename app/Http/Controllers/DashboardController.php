<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Event;
use App\Models\Lowongan;
use App\Models\Mentorship;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil total data dari masing-masing tabel
        $totalBerita = Berita::count();
        $totalEvent = Event::count();
        $totalMentor = Mentorship::count();
        $totalLowongan = Lowongan::count();
        $totalAlumni = User::where('role', 'alumni')->count(); // Sesuaikan field untuk alumni
        $totalMentor = User::where('role', 'mentor')->count();

        // Kirim data ke view
        return view('dashboard', [
            'totalBerita' => $totalBerita,
            'totalEvent' => $totalEvent,
            'totalMentor' => $totalMentor,
            'totalLowongan' => $totalLowongan,
            'totalAlumni' => $totalAlumni + $totalMentor,
            'total alumni mentor' => $totalMentor
        ]);
    }
}
