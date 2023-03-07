<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\PaymentParticipant;
use App\Models\Registration;
use App\Models\Setting;
use App\Models\SettingPayment;
use Illuminate\Http\Request;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function history()
    {
        session()->put('title', 'Tagihan Pembayaran');

        $setting = Setting::first();
        $year = session('school_year');
        $quota = empty($setting) ? null : ($setting->quota == null ? null : $setting->quota);
        $regist = Registration::where('school_year', 'like', "$year%")->select('id_participant')
            ->groupBy('id_participant')
            ->get()
            ->count();
        $quota = [
            'quota' => (int)$quota,
            'registration' => $regist
        ];


        $setting_payment = SettingPayment::first();
        $payment_participant = PaymentParticipant::where([
            ['id_participant', Auth::guard('participant')->user()->id],
            ['school_year', session('school_year')],
        ])->first();

        if ($setting_payment == null) {
            $status_payment = true;
        } else {
            if ($setting_payment->payment == 1) {
                $status_payment = empty($payment_participant) ? false : ($payment_participant->payment_status != 1 ? false : true);
            } else {
                $status_payment = true;
            }
        }
        // dd($status_payment);
        $data = [
            'id_participant' => Auth::guard('participant')->user()->id,
            'name' => Auth::guard('participant')->user()->name,
            'nisn' =>Auth::guard('participant')->user()->nisn,
            'registration_fee' => empty($setting_payment) ? null : $setting_payment->registration_fee,
            'note' => empty($setting_payment) ? null : $setting_payment->note,
            'nominal' => empty($payment_participant) ? null : $payment_participant->nominal,
            'on_behalf' => empty($payment_participant) ? null : $payment_participant->on_behalf,
            'home_bank' => empty($payment_participant) ? null : $payment_participant->home_bank,
            'destination_bank' => empty($payment_participant) ? null : $payment_participant->destination_bank,
            'account_number' => empty($payment_participant) ? null : $payment_participant->account_number,
            'description' => empty($payment_participant) ? null : $payment_participant->description,
            'proof' => empty($payment_participant) ? null : (empty($payment_participant->proof) ? null : $payment_participant->proof),
            'pay_date' => empty($payment_participant) ? null : $payment_participant->pay_date,
            'school_year' => session('school_year'),
            'status_payment' => empty($payment_participant) ? 3 : $payment_participant->payment_status,
        ];
        // dd($data);
        return view('content.participant.register.v_history', compact('data', 'status_payment', 'setting_payment', 'quota'));
    }

    public function billing()
    {
        // dd('billing');
        session()->put('title', 'Formulir Pembayaran');
        $setting_payment = SettingPayment::first();
        $payment_participant = PaymentParticipant::where([
            ['id_participant', Auth::guard('participant')->user()->id],
            ['school_year', session('school_year')],
        ])->first();
        // dd($payment_participant);

        if ($setting_payment == null) {
            $status_payment = true;
        } else {
            if ($setting_payment->payment == 1) {
                $status_payment = empty($payment_participant) ? false : ($payment_participant->payment_status != 1 ? false : true);
            } else {
                $status_payment = true;
            }
        }
        $data = [
            'id_participant' => Auth::guard('participant')->user()->id,
            'name' => Auth::guard('participant')->user()->name,
            'nisn' =>Auth::guard('participant')->user()->nisn,
            'registration_fee' => empty($setting_payment) ? null : $setting_payment->registration_fee,
            'note' => empty($setting_payment) ? null : $setting_payment->note,
            'nominal' => empty($payment_participant) ? null : $payment_participant->nominal,
            'on_behalf' => empty($payment_participant) ? null : $payment_participant->on_behalf,
            'home_bank' => empty($payment_participant) ? null : $payment_participant->home_bank,
            'destination_bank' => empty($payment_participant) ? null : $payment_participant->destination_bank,
            'account_number' => empty($payment_participant) ? null : $payment_participant->account_number,
            'description' => empty($payment_participant) ? null : $payment_participant->description,
            'proof' => empty($payment_participant) ? null : (empty($payment_participant->proof) ? null : $payment_participant->proof),
            'pay_date' => empty($payment_participant) ? null : $payment_participant->pay_date,
            'school_year' => session('school_year'),
            'status_payment' => empty($payment_participant) ? 0 : $payment_participant->status,
        ];
        // dd($data);
        return view('content.participant.register.v_formulir', compact('data'));
    }

    public function save_billing(Request $request)
    {
        $payment_participant = PaymentParticipant::where([
            ['id_participant', $request->id_participant],
            ['school_year', $request->school_year]
        ])->first();

        $data = array(
            'payment_method' => 'transfer',
            'nominal' => str_replace('.', '', $request->nominal),
            'on_behalf' => $request->on_behalf,
            'home_bank' => $request->home_bank,
            'destination_bank' => $request->destination_bank,
            'account_number' => $request->account_number,
            'pay_date' => date('Y-m-d', strtotime($request->pay_date)),
        );

        if ($payment_participant == null) {
            if (!empty($request->proof)) {
                $data = Helper::upload_aws($request, 'proof', 'ppdb/image/payment/proof/', $data, 'null|null', 'null|null');
            }else{
                $data['proof'] = null;
            }
            $data['payment_status'] = 0;
        } else {
            if (!empty($request->proof)) {
                $data = Helper::upload_aws($request, 'proof', 'ppdb/image/payment/proof/', $data, 'null|null', 'null|null');
            }else{
                $data['proof'] = $payment_participant->proof;
            }
            $data['payment_status'] = $payment_participant->payment_status == 2 ? 0 : $payment_participant->payment_status;
        }

        PaymentParticipant::updateOrCreate(
            [
                'id_participant' => $request->id_participant,
                'school_year' => $request->school_year
            ],
            $data
        );

        return response()->json([
            'message' => 'Pembayaran berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function invoice()
    {
        $id_participant = decrypt($_GET['participant']);
        $participant = Participant::find(decrypt($_GET['participant']));
        $school = Setting::first();
        $setting_payment = SettingPayment::first();
        $payment = PaymentParticipant::where([
            ['id_participant', decrypt($_GET['participant'])],
            ['payment_status', '!=', 2],
            ['school_year', 'like', session('school_year')."%"]
        ])->get()->last();

        $data = [
            'id' => $participant->id,
            'nisn' => $participant->nisn,
            'name' => $participant->name,
            'phone' => $participant->phone,
            'email' => $participant->email,
            'nominal' => empty($payment) ? $setting_payment->registration_fee : $payment->nominal,
            'pay_date' => empty($payment) ? now()->format('d M Y') : Carbon::parse($payment->pay_date)->format('d M Y'),
            'school_year' => $school->school_year,
            'information' => $setting_payment->information,
            'logo' => empty($school->logo1) ? null : asset($school->logo1),
            'status' => empty($payment) ? 'Belum Dibayar' : ($payment->payment_status == 1 ? 'Lunas' : 'Menunggu Konfirmasi'),
        ];
        $name_file = $data['status'] == "Lunas" ? 'Kwitansi-' . $data['nisn'] . '' : 'Invoice-' . $data['nisn'] . '';
        session()->put('title', "$name_file.pdf");
        $pdf = Pdf::loadview('content.participant.register.v_invoice', compact('data'))
            ->setPaper('a4', 'potrait')
            ->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }
}
