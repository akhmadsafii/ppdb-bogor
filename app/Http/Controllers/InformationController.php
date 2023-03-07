<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        // dd('ping');
        $title = 'Alur Pendaftaran';
        if (request()->segment(2) == 'requirement') {
            $title = 'Syarat Pendaftaran';
        } else if (request()->segment(2) == 'guide') {
            $title = 'Panduan Pendaftaran';
        } else if (request()->segment(2) == 'faq') {
            $title = 'Pertanyaan yang Sering Diajukan';
        } else if (request()->segment(2) == 'greeting') {
            $title = 'Sambutan';
        }

        session()->put('title', $title);
        $link = request()->segment(2);
        $page = Page::where('link', $link)->first();
        // dd($page);
        return view('content.public.v_information', compact('page'));
    }
}
