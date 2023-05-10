<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppearanceController extends Controller
{
    public function index()
    {
        session()->put('title', 'Pengaturan Tampilan');
        $setting = json_decode(Storage::get('settings.json'), true);
        return view('content.admin.setting.v_appearance', compact('setting'));
    }

    public function update(Request $request)
    {
        $settings = [
            'background' => $request['background'],
            'color' => $request['color'],
            'background_active' => $request['background_active'],
            'size_compress' => $request['size_compress'],
            'format_image' => $request['format_image'],
            'format_file' => $request['format_file'],
            'max_upload' => $request['max_upload'],
            'leaflet_premium' => $request['leaflet_premium'],
            'leaflet_token' => $request['leaflet_token'],
            'footer' => $request['footer'],
        ];
        // if ($request['leaflet_premium' == 1]) {
        //     $settings['leaflet_token'] = $request['token_leaflet'];
        // }
        Storage::put('settings.json', json_encode($settings, JSON_PRETTY_PRINT));
        return response()->json([
            'message' => 'Settingan berhasil diperbarui',
            'status' => true,
        ], 200);
    }
}
