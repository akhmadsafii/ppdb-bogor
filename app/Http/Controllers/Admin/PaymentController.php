<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\PaymentParticipant;
use App\Models\Setting;
use App\Models\SettingPayment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $status = 0;
        if($_GET['status'] == 'approved'){
            $status = 1;
        }elseif($_GET['status'] == 'canceled'){
            $status = 2;
        }
        session()->put('title', 'Pembayaran');
        $years = PaymentParticipant::groupBy('school_year')->select('school_year')->get();
        $setting = Setting::first();
        $year = empty($setting) ? null : (empty($setting->school_year) ? null : $setting->school_year);
        $fix_year = $request->school_year ?? $year;

        $data = PaymentParticipant::where([
            ['school_year', 'like', "$fix_year%"],
            ['payment_status', $status]
        ]);
        if ($request->ajax()) {
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group" aria-label="Horizontal Button Group">';
                    $btn = '<a href="javascript:void(0)" class="m-1 detail btn btn-purple btn-sm" data-id="' . $row['id'] . '"><i class="material-icons list-icon md-18">info_outline</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="m-1 edit btn btn-info btn-sm" data-id="' . $row['id'] . '"><i class="material-icons list-icon md-18">edit</i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    $img = '<span class="text-danger">-</span>';
                    if ($row['proof'] != null) {
                        $img = '<a href="' . Helper::showImage($row['proof']) . '" target="_blank"><img class="rounded" width="55" src="' . Helper::showImage('thumb/'.$row['proof']) . '" alt="user"></a>';
                    }
                    return $img;
                })
                ->editColumn('pay_date', function ($row) {
                    return Helper::formatMonth($row->pay_date);
                })
                ->editColumn('nominal', function ($row) {
                    return str_replace(',', '.', number_format($row['nominal']));
                })
                ->editColumn('nisn', function ($row) {
                    return $row->participants->nisn;
                })
                ->editColumn('name_participant', function ($row) {
                    return $row->participants->name;
                })
                ->editColumn('check', function ($row) {
                    return '<input type="checkbox" name="participant[]"
                        class="single-check" value="' . $row['id'] . '" />';
                })
                ->rawColumns(['action', 'image', 'nisn', 'name_participant', 'check', 'pay_date', 'nominal'])
                ->make(true);
        }
        return view('content.admin.payment.v_payment', compact('years', 'setting'));
    }

    public function pending(Request $request)
    {
        session()->put('title', 'Menunggu Pembayaran');
        $payment_participant = PaymentParticipant::get();
        $id_participant = $payment_participant->pluck('id_participant');
        $participant = Participant::whereNotIn('id', $id_participant)->get();
        $setting_payment = SettingPayment::first();
        $setting = Setting::first();
        $years = PaymentParticipant::groupBy('school_year')->select('school_year')->get();
        if(empty($setting_payment)){
            return redirect()->route('setting.payment');
        }
        $data = [];
        if ($setting_payment->payment == 1) {
            foreach ($participant as $prt) {
                $data[] = [
                    'id' => $prt->id,
                    'name' => $prt->name,
                    'nisn' => $prt->nisn,
                    'email' => $prt->email,
                    'phone' => $prt->phone,
                    'registration_fee' => $setting_payment->registration_fee,
                    'status' => 'Belum Bayar',
                ];
            }
        }
        // dd($data);
        if ($request->ajax()) {
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('nominal', function ($row) {
                    return str_replace(',', '.', number_format($row['registration_fee']));
                })
                ->editColumn('status', function ($row) {
                    return '<span class="alert alert-danger">'.$row['status'].'</span>';
                })
                ->rawColumns(['status', 'nominal'])
                ->make(true);
        }
        return view('content.admin.payment.v_pending', compact('years', 'setting'));
    }

    public function detail(Request $request)
    {
        // dd($request);
        $payment = PaymentParticipant::with('participants')->find($request['id']);
        $proof = null;
        if($payment['proof'] != null){
            $proof = Helper::showImage('thumb/'.$payment['proof']);
        }
        $status = 'menunggu konfirmasi';
        if($payment['payment_status'] == 1){
            $status = 'Pembayaran diterima';
        }elseif($payment['payment_status'] == 2){
            $status = 'Pembayaran ditolak';
        }
        $payment['status_payment'] = $status;
        $payment['proof'] = $proof;
        $payment['pay_date'] = Helper::formatMonth($payment['pay_date']);
        return response()->json($payment);
    }

    public function update_payment(Request $request)
    {
        // dd($request);
        PaymentParticipant::where('id', $request['id'])->update([
            'payment_status' => $request['status_payment'],
            'description' => $request['description'],
        ]);
        return response()->json([
            'message' => 'Status Pembayaran berhasil diperbarui',
            'status' => true,
        ], 200);
    }

    public function update_decision_at_time(Request $request)
    {
        // dd($request);
        PaymentParticipant::whereIn('id', json_decode($request['id_payment']))->update([
            'payment_status' => $request['payment_status'],
            'description' => $request['description'],
        ]);
        return response()->json([
            'message' => 'Pembayaran berhasil diperbarui',
            'status' => true,
        ], 200);

    }

}
