<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
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

        $max_size = 'max:' . env('SETTING_MAX_UPLOAD_IMAGE');
        $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'title' => ['required'],
            'content' => ['required'],
        ];

        $messages = [
            'required' => ':attribute harus diisi.',
            'mimes' => 'Format tipe gambar :attribute yang diupload tidak diperbolehkan',
            'max' => 'Ukuran maksimal file ' . env('SETTING_MAX_UPLOAD_IMAGE') / 1000 . ' MB',
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

            if (!empty($request->file)) {
                if ($request->id != null) {
                    $page = Page::find($request->id);
                    Helper::delete_aws($page->file);
                }
                if($request->link == 'greeting'){
                    $data = Helper::upload_aws($request, 'file', 'ppdb/image/page/', $data, '300|400', '300|400');
                }else{
                    $data = Helper::upload_aws($request, 'file', 'ppdb/image/page/', $data, '1000|750', '1000|750');
                }
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
