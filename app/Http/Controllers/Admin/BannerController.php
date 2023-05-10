<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        session()->put('title', 'Banner');
        $banner = Banner::first();
        return view('content.admin.banner.v_banner', compact('banner'));
    }

    public function store(Request $request)
    {
        $customAttributes = [
            'title' => 'Judul Banner',
            'description' => 'Isi Banner',
        ];

        $setting = json_decode(Storage::get('settings.json'), true);
        $max_size = 'max:' . $setting['max_upload'];
        $mimes = 'mimes:' . $setting['format_image'];
        $rules = [
            'image' => ['file', 'image', $mimes, $max_size],
            'title' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'description' => ['required'],
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
                'description' => $request->description,
            ];

            if ($request->hasFile('file')) {
                $data = ImageHelper::upload_asset($request, 'file', 'banner', $data);
            }
            Banner::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Data Banner berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }
}
