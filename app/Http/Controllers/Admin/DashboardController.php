<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Participant;
use App\Models\PaymentParticipant;
use App\Models\Registration;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        // dd(session()->all());
        $setting = Setting::first();
        if (Auth::guard('admin')->check()) {
            $guard = 'admin';
        } else {
            $guard = 'supervisor';
        }
        if (Auth::guard($guard)->user()->file != 'user.png') {
            session()->put('avatar', Auth::guard($guard)->user()->file);
        }
        session()->put('title', 'Dashboard Admin');
        $year = session('school_year');
        $payment = PaymentParticipant::where('school_year', 'like', "$year%")->get();

        $register = Registration::where('school_year', 'like', "$year%")->select('id_participant')->groupBy('id_participant')->get();
        $total = $register->count();

        $payment_result = [
            'total' => $total,
            'payment_confirm' => $payment->where('payment_status', 1)->sum('nominal'),
            'all_payment' => $payment->sum('nominal'),
        ];
        $group_id = Registration::where('school_year', 'like', "$year%")->select('id_participant')->groupBy('id_participant')->pluck('id_participant');

        $participant = Participant::whereIn('id', $group_id)->get();

        $participant_approved = [
            'total' => $participant->count(),
            'approved' => $participant->where('decision', 1)->count(),
            'canceled' => $participant->where('decision', 0)->count(),
            'not_decided' => $participant->where('decision', 2)->count(),
        ];

        $message = Message::with('participants')->where('closed', 0)->get();
        // dd($message);

        if ($request->ajax()) {
            $data = PaymentParticipant::where([
                ['school_year', 'like', "$year%"],
                ['payment_status', 0]
            ]);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group" aria-label="Horizontal Button Group">';
                    $btn = '<a href="javascript:void(0)" class="m-1 detail btn btn-purple btn-sm" data-id="' . $row['id'] . '"><i class="material-icons list-icon md-18">info_outline</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="m-1 edit btn btn-info btn-sm" data-id="' . $row['id'] . '"><i class="material-icons list-icon md-18">edit</i></a>';
                    $btn .= '</div>';
                    return $btn;
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
                ->rawColumns(['action', 'image', 'nisn', 'name_participant', 'check', 'pay_date', 'nominal'])
                ->make(true);
        }

        return view('content.admin.v_dashboard', compact('payment_result', 'participant_approved', 'message', 'setting'));
    }
}
