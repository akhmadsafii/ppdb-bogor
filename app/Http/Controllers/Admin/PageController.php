<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $page = Page::where('link', '=', request()->segment(3))->first();
        // dd($page);
        return view('content.admin.page.v_page', compact('page'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'title' => 'Judul',
            'content' => 'Isi',
        ];

        $setting = json_decode(Storage::get('settings.json'), true);
        $max_size = 'max:' . $setting['max_upload'];
        $mimes = 'mimes:' . $setting['format_image'];
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'title' => ['required'],
            'content' => ['required'],
        ];

        $messages = [
            'required' => ':attribute harus diisi.',
            'mimes' => 'Format tipe gambar :attribute yang diupload tidak diperbolehkan',
            'max' => 'Ukuran maksimal file ' . $setting['max_upload'] / 1000 . ' MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'status' => false,
            ], 302);
        } else {
            $data = [
                'title' => $request->title,
                'content' => $request->content
            ];

            if ($request->hasFile('file')) {
                $data = ImageHelper::upload_asset($request, 'file', 'page', $data);
            }
            Page::updateOrCreate(
                ['link' => $request->link],
                $data
            );
            return response()->json([
                'message' => 'Data berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }
}
