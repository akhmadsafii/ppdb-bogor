<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppearanceController extends Controller
{
    public function index()
    {
        session()->put('title', 'Pengaturan Tampilan');
        $setting = array(
            'background' => env("SETTING_BACKGROUND"),
            'color' => env("SETTING_COLOR"),
            'background_active' => env("SETTING_BACKGROUND_ACTIVE"),
            'resolution' => env("SETTING_RESOLUTION"),
            'max_upload' => env("SETTING_MAX_UPLOAD_IMAGE"),
            'format_image' => env("SETTING_FORMAT_IMAGE"),
            'format_file' => env("SETTING_FORMAT_FILE"),
            'leaflet_premium' => env("SETTING_LEAFLET_PREMIUM"),
            'token_leaflet' => env("SETTING_TOKEN_LEAFLET"),
            'footer' => env("SETTING_FOOTER"),
        );
        // dd($setting);
        return view('content.admin.setting.v_appearance', compact('setting'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $setting = array(
            'background' => env("SETTING_BACKGROUND"),
            'color' => env("SETTING_COLOR"),
            'background_active' => env("SETTING_BACKGROUND_ACTIVE"),
            'max_upload' => env("SETTING_MAX_UPLOAD_IMAGE"),
            'format_image' => env("SETTING_FORMAT_IMAGE"),
            'format_file' => env("SETTING_FORMAT_FILE"),
            'leaflet_premium' => env("SETTING_LEAFLET_PREMIUM"),
            'token_leaflet' => env("SETTING_TOKEN_LEAFLET"),
            'footer' => env("SETTING_FOOTER"),
        );
        $token_leaflet = '';
        if ($request->leaflet_premium == 1) {
            $token_leaflet = $request->token_leaflet;
        }
        Helper::envUpdate('SETTING_BACKGROUND="' . $setting['background'] . '"', 'SETTING_BACKGROUND="' . $request->background . '"');
        Helper::envUpdate('SETTING_COLOR="' . $setting['color'] . '"', 'SETTING_COLOR="' . $request->color . '"');
        Helper::envUpdate('SETTING_BACKGROUND_ACTIVE="' . $setting['background_active'] . '"', 'SETTING_BACKGROUND_ACTIVE="' . $request->background_active . '"');
        Helper::envUpdate('SETTING_MAX_UPLOAD_IMAGE="' . $setting['max_upload'] . '"', 'SETTING_MAX_UPLOAD_IMAGE="' . $request->max_upload . '"');
        Helper::envUpdate('SETTING_FORMAT_IMAGE="' . $setting['format_image'] . '"', 'SETTING_FORMAT_IMAGE="' . str_replace(',', '|', $request->format_image) . '"');
        Helper::envUpdate('SETTING_FORMAT_FILE="' . $setting['format_file'] . '"', 'SETTING_FORMAT_FILE="' . str_replace(',', '|', $request->format_file) . '"');
        Helper::envUpdate('SETTING_LEAFLET_PREMIUM="' . $setting['leaflet_premium'] . '"', 'SETTING_LEAFLET_PREMIUM="' . $request->leaflet_premium . '"');
        Helper::envUpdate('SETTING_TOKEN_LEAFLET="' . $setting['token_leaflet'] . '"', 'SETTING_TOKEN_LEAFLET="' . $token_leaflet . '"');
        Helper::envUpdate('SETTING_FOOTER="' . $setting['footer'] . '"', 'SETTING_FOOTER="' . $request->footer . '"');
        return response()->json([
            'message' => 'Settingan berhasil diperbarui',
            'status' => true,
        ], 200);
    }
}
