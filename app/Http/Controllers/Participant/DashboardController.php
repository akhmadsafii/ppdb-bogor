<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $check_payment = Helper::checkPayment();
        $setting = Setting::first();
        // dd($setting);
        return view('content.participant.v_dashboard', compact('check_payment', 'setting'));
    }
}
