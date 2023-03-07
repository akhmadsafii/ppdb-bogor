<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\SettingPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingPaymentController extends Controller
{
    public function index()
    {
        session()->put('title', 'Pengaturan Pembayaran');
        $setting = SettingPayment::first();
        return view('content.admin.setting.v_payment', compact('setting'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Settingan',
            'registration_fee' => 'Biaya Pendaftaran',
            'payment' => 'Verifikasi Pembayaran',
        ];

        $rules = [
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'registration_fee' => ['required'],
            'payment' => ['required'],
        ];

        $messages = [
            'required' => ':attribute harus diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'status' => false,
            ], 302);
        } else {
            $data = [
                'registration_fee' =>  str_replace('.', '', $request->registration_fee),
                'name' => $request->name,
                'payment' => $request->payment,
                'information' => $request->information,
            ];
            SettingPayment::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Settingan Pembayaran berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }
}
