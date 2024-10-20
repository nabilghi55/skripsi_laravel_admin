<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('mentor')->where('is_booked', false)->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function book(Request $request, $id)
    {
        $request->validate([
            'mentee_id' => 'required|exists:users,id',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->is_booked = true;
        $schedule->mentee_id = $request->mentee_id;
        $schedule->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Schedule booked successfully!',
        ], 200);
    }
}
