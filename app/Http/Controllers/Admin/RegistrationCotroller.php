<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ParticipantExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\PaymentParticipant;
use App\Models\Registration;
use App\Models\Setting;
use App\Models\SettingForm;
use App\Models\SettingPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class RegistrationCotroller extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Peserta Pendaftar');
        $data = [];
        $years = Registration::groupBy('school_year')->select('school_year')->get();
        $setting = Setting::first();
        // dd($setting);
        $lat_school = empty($setting) ? 0 : (empty($setting->latitude) ? 0 : $setting->latitude);
        $long_school = empty($setting) ? 0 : (empty($setting->longitude) ? 0 : $setting->longitude);
        $year = empty($setting) ? null : (empty($setting->school_year) ? null : $setting->school_year);
        $fix_year = $request->school_year ?? $year;
        $registration = Registration::where('school_year', $fix_year)->get();
        $participant_registration = $registration->pluck('id_participant');
        $participant = Participant::whereIn('id', $participant_registration);

        if ($_GET['based'] == 'pending') {
            $participant->where('decision', 2);
        }
        if ($_GET['based'] == 'rejected') {
            $participant->where('decision', 3);
        }
        if ($_GET['based'] == 'approved') {
            $participant->where('decision', 1);
        }
        $participant = $participant->get();
        // dd($participant);
        foreach ($participant as $prt) {
            $school_origin = collect($registration)->where('id_participant', $prt->id)->where('id_form', 49)->first();
            $lane_register = collect($registration)->where('id_participant', $prt->id)->where('id_form', 6)->first();
            $lat = empty($prt) ? 0 : (empty($prt->latitude) ? 0 : $prt->latitude);
            $lon = empty($prt) ? 0 : (empty($prt->longitude) ? 0 : $prt->longitude);
            $distance = Helper::getDistanceBetween($lat, $lon, $lat_school, $long_school);
            $data[] = [
                'id' => $prt->id,
                'file' => $prt->file,
                'name' => $prt->name,
                'email' => $prt->email,
                'nisn' => $prt->nisn,
                'school_origin' => empty($school_origin) ? null : $school_origin->value,
                'distance' => $distance,
                'decision' => $prt->decision,
                'status' => $prt->status,
                'school_year' => $fix_year,
                'lane_register' => empty($lane_register) ? null : $lane_register->value,
            ];
        }
        // dd($data);
        if ($request->ajax()) {
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group" aria-label="Horizontal Button Group">';
                    $btn = '<a href="javascript:void(0)" class="m-1 detail btn btn-purple btn-sm" data-id="' . $row['id'] . '"><i class="material-icons list-icon md-18">info_outline</i></a>';
                    $btn .= '<a href="' . route('document.participant', ['name' => Str::slug($row['name']), 'key' => encrypt($row['id'])]) . '" class="m-1 btn btn-facebook btn-sm"><i class="material-icons list-icon md-18">attachment</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="m-1 edit btn btn-info btn-sm" data-id="' . $row['id'] . '"><i class="material-icons list-icon md-18">edit</i></a>';
                    $btn .= '<a href="' . route('master_registration.print_preview', ['year' => $row['school_year'], 'key' => encrypt($row['id']), 'name' => Str::slug($row['name'])]) . '" target="_blank" class="m-1 btn btn-success btn-sm" ><i class="material-icons list-icon md-18">local_printshop</i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    $img = '<img class="rounded" height="40" src="' . asset('asset/image/user.png') . '" alt="user">';
                    if ($row['file'] != 'user.png') {
                        $img = '<a href="' . Helper::showImage($row['file']) . '" target="_blank"><img class="rounded" width="55" src="' .  Helper::showImage('thumb/'. $row['file']) . '" alt="user"></a>';
                    }
                    return $img;
                })
                ->editColumn('status', function ($row) {
                    $check = '';
                    if ($row['status'] == 1) {
                        $check = 'checked';
                    }
                    return '<label class="switch">
                    <input type="checkbox" ' . $check . ' class="status_check" data-id="' . $row['id'] . '">
                    <span class="slider round"></span>
                </label>';
                })
                ->editColumn('decision', function ($row) {
                    $decision = 'Menunggu';
                    $class = 'warning';
                    if ($row['decision'] == 1) {
                        $decision = 'Diterima';
                        $class = 'success';
                    } elseif ($row['decision'] == 3) {
                        $decision = 'Ditolak';
                        $class = 'danger';
                    }
                    return '<span class="badge alert-' . $class . '">' . $decision . '</span>';
                })
                ->editColumn('check', function ($row) {
                    return '<input type="checkbox" name="participant[]"
                        class="single-check" value="' . $row['id'] . '" />';
                })
                ->rawColumns(['action', 'image', 'decision', 'status', 'check'])
                ->make(true);
        }
        return view('content.admin.registration.v_register', compact('years', 'setting'));
    }

    public function action()
    {
        session()->put('title', 'Tambah Pendaftar');
        $setting = Setting::first();
        $school_year = $setting['school_year'] ?? '';
        // dd($school_year);
        if ($school_year) {
            $participant = Participant::find(decrypt($_GET['code']));
            // dd($participant);
            $registration = $participant->registrations()->where('school_year', 'like', "$school_year%")->get();
            // dd($registration);
            $form_register = SettingForm::where('status_form', 1)->orderBy('order_form', 'ASC')->get();
            $setting_payment = SettingPayment::first();
            $participant_payment = PaymentParticipant::where('id_participant', decrypt($_GET['code']))->get()->last();
            $form_registration = [];
            foreach ($form_register as $reg) {
                // dd($reg);
                if ($reg->initial == 'jurusan') {
                    $val = empty($setting) ? null : $setting->major;
                } elseif ($reg->initial == 'jurusan2') {
                    $val = empty($setting) ? null : $setting->major;
                } elseif ($reg->initial == 'jurusan3') {
                    $val = empty($setting) ? null : $setting->major;
                } elseif ($reg->initial == 'nama') {
                    $val = $participant->name;
                } elseif ($reg->initial == 'nisn') {
                    $val = $participant->nisn;
                } elseif ($reg->initial == 'email') {
                    $val = $participant->email;
                } elseif ($reg->initial == 'jalur_pendaftaran') {
                    $val = empty($setting) ? null : (empty($setting->track_ppdb) ? 'zonasi' : $setting->track_ppdb);
                } elseif ($reg->initial == 'nomor_pendaftaran') {
                    $number = empty($setting) ? null : $setting->auto_number;
                    if ($number == null) {
                        $val = null;
                    } elseif ($number != 1) {
                        $val = null;
                    } else {
                        $id_form = SettingForm::where('initial', '=', 'nomor_pendaftaran')->first()->id;
                        $participant_register = Registration::where([
                            ['id_form', $id_form],
                            ['school_year', 'like', "$school_year%"],
                        ])->orderBy('value', 'DESC')->first();
                        $val = empty($participant_register) ? 1 : (empty($participant_register->value) ? 1 : (int) $participant_register->value + 1);
                    }
                } else {
                    if ($registration == null) {
                        $val = null;
                    } else {
                        $first_form = collect($registration)->where('id_form', $reg->id)->first();
                        $val = empty($first_form) ? null : $first_form->value;
                    }
                }

                $form_registration[] = [
                    'id' => $reg->id,
                    'initial' => $reg->initial,
                    'name' => $reg->name,
                    'type' => $reg->type,
                    'value' => $val,
                ];
            }
            // dd($participant_payment);

            if ($setting_payment != null) {
                if ($setting_payment->payment == 1) {
                    $form = empty($participant_payment) ? null : ($participant_payment->payment_status == 1 ? $form_registration : null);
                } else {
                    $form = $form_registration;
                }

            } else {
                $form = $form_registration;
            }
            // dd($form);
            return view('content.admin.registration.v_form_register', compact('form'));

        } else {
            return redirect()->back()->withErrors(['message' => 'Settingan PPDB untuk tahun ajaran belum di set!']);
        }
    }

    public function store(Request $request)
    {
        $p = $request;
        // dd(decrypt($p['code']));
        $setting = Setting::first();
        // dd($setting);
        $school_year = $setting['school_year'];
        if ($school_year) {
            for ($i = 1; $i <= $p['total']; $i++) {
                Registration::updateOrCreate(
                    [
                        'id_participant' => decrypt($p['code']),
                        'id_form' => $p['id_form_' . $i],
                        'school_year' => $school_year,
                    ],
                    [
                        'value' => $p['value_form_' . $i],
                    ]
                );
            }
            Participant::where('id', decrypt($p['code']))->update(['register2' => 1]);
            return response()->json([
                'message' => 'Registrasi berhasil disimpan',
                'status' => true,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Tahun ajaran di setting belum diset',
                'status' => false,
            ], 302);
        }
    }

    public function detail(Request $request)
    {
        $setting = Setting::first();
        $year = empty($setting) ? null : (empty($setting->school_year) ? null : $setting->school_year);
        $registration = Registration::with('forms')->where([
            ['id_participant', $request->id],
            ['school_year', $year],
        ])->get();
        $result = [];
        foreach ($registration as $reg) {
            $result[] = array(
                'label' => $reg->forms->name,
                'value' => $reg->value,
            );
        }
        return response()->json($result);
    }

    public function update_decision(Request $request)
    {
        Participant::where('id', $request['id'])->update([
            'decision' => $request['decision'],
            'decision_statement' => $request['decision_statement'],
        ]);
        return response()->json([
            'message' => 'Keputusan berhasil diperbarui',
            'status' => true,
        ], 200);

    }

    public function update_decision_at_time(Request $request)
    {
        // dd($request);
        PaymentParticipant::whereIn('id', json_decode($request['id_participant']))->update([
            'decision' => $request['decision'],
            'decision_statement' => $request['decision_statement'],
        ]);
        return response()->json([
            'message' => 'Keputusan berhasil diperbarui',
            'status' => true,
        ], 200);

    }

    public function print_preview()
    {
        $participant = Participant::find(decrypt($_GET['key']));
        $head = Setting::first();
        $year = $_GET['year'];
        $letterhead = [
            'header1' => empty($head) ? null : (empty($head->head1) ? null : $head->head1),
            'header2' => empty($head) ? null : (empty($head->head2) ? null : $head->head2),
            'header3' => empty($head) ? null : (empty($head->head3) ? null : $head->head3),
            'address' => empty($head) ? null : (empty($head->address) ? null : $head->address),
            'logo' => empty($head) ? null : (empty($head->logo1) ? null : asset($head->logo1)),
            'logo2' => empty($head) ? null : (empty($head->logo2) ? null : asset($head->logo2)),
        ];


        $data = SettingForm::where('status_form', 1)->orderBy('order_form', 'ASC')->get();

        $form_value = Registration::where([
            ['id_participant', $participant->id],
            ['school_year', 'like', "$year%"]
        ])->get();

        $col_form = collect($form_value);

        // dd($data);
        foreach ($data as $form) {
            $form_val = $col_form->where('id_form', $form->id)->first();
            $main_form[] = [
                'id' => $form->id,
                'name' => $form->name,
                'value' => empty($form_val) ? null : $form_val['value'],
            ];
        }

        return view('content.admin.registration.v_print_register', compact('letterhead', 'main_form', 'year'));
    }

    public function exports()
    {
        $school_year = $_GET['year'];
        return Excel::download(new ParticipantExport($school_year), '' . Carbon::now()->timestamp . '_peserta_ppdb.xls');
    }
}
