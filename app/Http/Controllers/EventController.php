<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function __construct()
    {
        $this->middleware('role:admin')->except(['getAllEvents', 'getEventById', 'index', 'show', 'apiRegister']);
    }

    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'description' => 'nullable',
            'images' => 'nullable|image|max:2048',
        ]);
    
        try {
            $data = $request->all();
    
            if ($request->hasFile('images')) {
                $data['images'] = $request->file('images')->store('events', 'public');
            }
    
            Event::create($data);
    
            return redirect()->route('admin.event.index')->with('success', 'Event berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->route('admin.event.create')->withErrors(['error' => 'Terjadi kesalahan saat menyimpan event.']);
        }
    }
    

    public function edit(Event $event)
    {
        $event->date = Carbon::parse($event->date); // Disesuaikan dengan kolom date yang ada di model terbaru
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'description' => 'nullable',
            'images' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('images')) {
            // Hapus gambar lama jika ada
            if ($event->images && \Storage::exists('public/' . $event->images)) {
                \Storage::delete('public/' . $event->images);
            }
            $data['images'] = $request->file('images')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        return view('admin.event.show', compact('event'));
    }

    public function getAllEvents()
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Anda harus login untuk mengakses halaman ini.'
            ], 401);
        }
        $events = Event::all();
        return response()->json([
            'status' => 'success',
            'data' => $events
        ], 200);
    }

    public function registrations(Event $event)
    {
        // Ambil data pendaftar terkait dengan event
        $registrations = $event->registrations;

        return view('admin.event.registrations', compact('event', 'registrations'));
    }

    /**
     * API: Get a specific event by ID.
     */
    public function getEventById($id)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Anda harus login untuk mengakses halaman ini.'
            ], 401);
        }
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'status' => 'error',
                'message' => 'Event tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $event
        ], 200);
    }

    public function apiRegister(Request $request, $eventId)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|string|max:50',
            'nomor_hp' => 'required|string|max:15',
        ]);

        $event = Event::findOrFail($eventId);

        $registration = $event->registrations()->create([
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'nomor_hp' => $request->nomor_hp,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pendaftaran berhasil!',
            'data' => $registration
        ], 201);
    }
}
