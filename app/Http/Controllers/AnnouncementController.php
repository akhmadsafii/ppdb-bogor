<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        session()->put('title', 'Pengumuman');
        $announcement = Announcement::where('status', 1)->get();
        return view('content.public.v_announcement', compact('announcement'));
    }

    public function preview()
    {
        $announcement = Announcement::where('code', $_GET['title'])->first();
        // dd($announcement);
        $announcement->update(['viewer' => $announcement->viewer + 1]);
        return view('content.public.v_detail_announcement', compact('announcement'));
    }
}
