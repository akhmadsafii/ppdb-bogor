<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\RegistrationSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Jadwal Pendaftaran');
        if ($request->ajax()) {
            $data = RegistrationSchedule::where('status', '!=', 0);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="mx-1 edit" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">edit</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 delete" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">delete</i></a>';
                    return $btn;
                })
                ->editColumn('start_date', function ($row) {
                    return Helper::formatMonth($row['start_date']);
                })
                ->editColumn('end_date', function ($row) {
                    return Helper::formatMonth($row['end_date']);
                })
                ->editColumn('status', function ($row) {
                    $check = '';
                    if ($row['status'] == 1) {
                        $check = 'checked';
                    }
                    return '<label class="switch">
                    <input type="checkbox" ' . $check . ' class="status_check" data-id="' . $row->id . '">
                    <span class="slider round"></span>
                </label>';
                })
                ->rawColumns(['action', 'status', 'start_date', 'end_date'])
                ->make(true);
        }
        return view('content.admin.schedule.v_schedule');
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Jadwal Pendaftaran',
            'place' => 'Tempat pendaftaran',
            'start_date' => 'Tanggal Mulai',
            'end_date' => 'Tanggal Selesai',
            'description' => 'Deskripsi Pendaftaran',
        ];
        $rules = [
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'place' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'description' => ['required'],
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
                'name' => $request->name,
                'place' => $request->place,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'end_date' => date('Y-m-d', strtotime($request->end_date)),
                'description' => $request->description,
                'sort' => $request->sort,
                'status' => $request->status
            ];
            RegistrationSchedule::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Jadwal Pendaftaran berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function detail(Request $request)
    {
        $detail = RegistrationSchedule::find($request->id);
        return response()->json($detail);
    }

    public function delete(Request $request)
    {
        RegistrationSchedule::where('id', $request->id)->update(array('status' => 0));
        return response()->json([
            'message' => 'Data Jadwal Pendaftaran berhasil dihapus',
            'status' => true,
        ], 200);
    }

    public function update_status(Request $request)
    {
        RegistrationSchedule::where('id', $request->id)->update(array('status' => $request->value));
        return response()->json([
            'message' => 'Jadwal Pendaftaran berhasil diupdate',
            'status' => true,
        ], 200);
    }
}
