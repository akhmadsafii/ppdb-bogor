<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    public function index()
    {
        $greeting = Page::where('link', 'greeting')->first();
        $banner = Banner::first();
        $setting = Setting::first();
        // dd($setting);
        return Cache::remember('main', 60, function () use ($greeting, $banner, $setting) {
            return view('content.public.v_index')->with(['greeting' => $greeting, 'banner' => $banner, 'setting' => $setting])->render();
        });
    }
}
