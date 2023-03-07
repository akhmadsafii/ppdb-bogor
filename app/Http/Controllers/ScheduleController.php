<?php

namespace App\Http\Controllers;

use App\Models\RegistrationSchedule;

class ScheduleController extends Controller
{
    public function index()
    {
        session()->put('title', 'Rangkaian Kegiatan');
        $schedule = RegistrationSchedule::where('status', 1)->orderBy('sort', 'ASC')->get();
        // dd($schedule);
        return view('content.public.v_schedule', compact('schedule'));
    }
}
