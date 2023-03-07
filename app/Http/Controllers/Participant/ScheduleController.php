<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\RegistrationSchedule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Jadwal Pendaftaran');
        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }

        $data = RegistrationSchedule::where('status', '!=', 0);
        if ($request->ajax()) {
            return DataTables::of($data)->addIndexColumn()
                ->editColumn('start_date', function ($row) {
                    return Helper::formatMonth($row['start_date']);
                })
                ->editColumn('end_date', function ($row) {
                    return Helper::formatMonth($row['end_date']);
                })
                ->rawColumns(['start_date', 'end_date'])
                ->make(true);
        }
        return view('content.participant.schedule.v_schedule');
    }
}
