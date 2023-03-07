<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        session()->put('title', 'Daftar Pengumuman');
        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }
        $announcement = Announcement::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('content.participant.announcement.v_announcement', compact('announcement'));
    }

    public function preview()
    {
        $announcement = Announcement::where('code', $_GET['title'])->first();
        session()->put('title', 'Detail ' . $announcement->title);
        $announcement->update(['viewer' => $announcement->viewer + 1]);
        return view('content.participant.announcement.v_detail_announcement', compact('announcement'));
    }
}
