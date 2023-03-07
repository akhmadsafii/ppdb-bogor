<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $title = 'Alur Pendaftaran';
        if (request()->segment(3) == 'requirement') {
            $title = 'Syarat Pendaftaran';
        } else if(request()->segment(3) == 'guide') {
            $title = 'Panduan Pendaftaran';
        } else if(request()->segment(3) == 'faq') {
            $title = 'Pertanyaan yang Sering Diajukan';
        } else if(request()->segment(3) == 'greeting') {
            $title = 'Sambutan';
        }
        session()->put('title', $title);

        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }
        $link = request()->segment(3);
        $page = Page::where('link', $link)->first();
        // dd($page);
        return view('content.participant.pages.v_page', compact('page'));
    }
}
