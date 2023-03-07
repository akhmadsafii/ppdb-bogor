<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $title = 'Download Brosur';
        if (request()->segment(2) == 'file') {
            $title = 'Download Dokumen';
        }
        session()->put('title', $title);
        $download = Download::where('type', request()->segment(2))->paginate(10);
        // dd($download);
        return view('content.public.v_download', compact('download'));
    }
}
