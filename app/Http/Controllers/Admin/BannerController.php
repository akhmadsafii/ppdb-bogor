<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
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

        $max_size = 'max:' . env('SETTING_MAX_UPLOAD_IMAGE');
        $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_IMAGE'));
        $rules = [
            'image' => ['file', 'image', $mimes, $max_size],
            'title' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'description' => ['required'],
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
                'description' => $request->description,
            ];

            if (!empty($request->file)) {
                if ($request->id != null) {
                    $banner = Banner::find($request->id);
                    Helper::delete_aws($banner->file);
                }
                $data = Helper::upload_aws($request, 'file', 'ppdb/image/banner/', $data, '1500|500', 'null|null');
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
