<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Participant;
use App\Models\PaymentParticipant;
use App\Models\Registration;
use App\Models\Setting;
use App\Models\SettingForm;
use App\Models\SettingPayment;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RegisterController extends Controller
{
    public function formulir(Request $request)
    {
        session()->put('title', 'Formulir Pendaftaran');


        $participant = Participant::find(Auth::guard('participant')->user()->id);

        $setting = Setting::first();
        $setting_payment = SettingPayment::first();

        $payment_participant = PaymentParticipant::where([
            ['id_participant', $participant->id],
            ['school_year', session('school_year')],
        ])->first();

        if ($setting_payment == null) {
            $link = true;
        } else {
            if ($setting_payment->payment == 1) {
                $link = empty($payment_participant) ? false : ($payment_participant->status_payment != 1 ? false : true);
            } else {
                $link = true;
            }
        }

        if (!empty($setting->school_year)) {
            $form_registration  = [];
            $year = session('school_year');
            $registration = $participant->registrations()->where('school_year', 'like', "$year%")->get();
            $form_register = SettingForm::where([
                ['status_form', 1]
            ])->orderBy('order_form', 'ASC')->get();

            $payment_p = PaymentParticipant::where('id_participant', Auth::guard('participant')->user()->id)->get()->last();
            // dd($payment_p);

            foreach ($form_register as $reg) {
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
                    // dd($number);
                    if ($number == null) {
                        $val = null;
                    } elseif ($number != 1) {
                        $val = null;
                    } else {
                        $id_form = SettingForm::where('initial', '=', 'nomor_pendaftaran')->first()->id;
                        // dd($id_form);
                        $participant_register = Registration::where([
                            ['id_form', $id_form],
                            ['school_year', 'like', "$year%"]
                        ])->orderByRaw('CONVERT(value, SIGNED) desc')->first();
                        $val = empty($participant_register) ? 1 : (empty($participant_register->value) ? 1 :  (int)$participant_register->value + 1);
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
                    'value' => $val
                ];
            }
            if ($setting_payment != null) {
                if ($setting_payment->payment == 1) {
                    $form = empty($payment_p) ? null : ($payment_p->payment_status == 1 ? $form_registration : null);
                } else {
                    $form = $form_registration;
                }
            } else {
                $form = $form_registration;
            }

            // dd($form);

            $quota = empty($setting) ? null : ($setting->quota == null ? null : $setting->quota);
            $regist = Registration::where('school_year', 'like', "$year%")->select('id_participant')
                ->groupBy('id_participant')
                ->get()
                ->count();
            $quota = [
                'quota' => (int)$quota,
                'registration' => $regist
            ];

            $result = [
                'quota' => $quota,
                'form' => $form,
            ];
        } else {
            $result       = array();
        }
        // dd($quota);
        if ($quota['quota'] <= $quota['registration'] && $quota['quota'] != 0) {
            return view('content.participant.register.v_check_quota');
        }

        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }
        return view('content.participant.register.v_form_register', compact('link', 'result'));
    }

    public function save_form(Request $request)
    {
        $p = $request;
        for ($i = 1; $i <= $p['total']; $i++) {
            Registration::updateOrCreate(
                [
                    'id_participant' => Auth::guard('participant')->user()->id,
                    'id_form' => $p['id_registration_' . $i],
                    'school_year' => session('school_year'),
                ],
                [
                    'value' => $p['val_registration_' . $i],
                ]
            );
        }
        $participant = Participant::find(Auth::guard('participant')->user()->id);
        $participant->update(['register2' => 1]);
        return response()->json([
            'message' => 'Pendaftaran formulir berhasil',
            'status' => true,
        ], 200);
    }

    public function document(Request $request)
    {
        session()->put('title', 'Dokumen Pendukung');
        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }
        $participant = Participant::find(Auth::guard('participant')->user()->id);

        $data = Document::with('participants')->where([
            ['id_participant', Auth::guard('participant')->user()->id],
            ['status', '!=', 0]
        ]);
        // dd($data);
        if ($request->ajax()) {
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="mx-1 edit" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">edit</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 delete" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">delete</i></a>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    $img = '<img class="rounded" height="40" src="' . asset('asset/image/default.jpg') . '" alt="user">';
                    if ($row['file'] != null) {
                        $img = '<a href="' . Helper::showImage($row->file) . '" target="_blank"><img class="rounded" width="55" src="' . Helper::showImage('thumb/' . $row->file) . '" alt="user"></a>';
                    }
                    return $img;
                })
                ->editColumn('participant', function ($row) {
                    return $row->participants->name;
                })
                ->editColumn('nisn', function ($row) {
                    return $row->participants->nisn;
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
                ->rawColumns(['action', 'image', 'status', 'participant', 'nisn'])
                ->make(true);
        }

        return view('content.participant.register.v_document', compact('participant'));
    }

    public function store_document(Request $request)
    {
        $customAttributes = [
            'name' => 'Nama Document'
        ];

        $setting = json_decode(Storage::get('settings.json'), true);
        $max_size = 'max:' . $setting['max_upload'];
        $mimes = 'mimes:' . $setting['format_image'];

        $rules = [
            'file' => ['file', $mimes, $max_size, 'required'],
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
        ];

        $messages = [
            'required' => ':attribute harus diisi.',
            'mimes' => 'Format tipe gambar :attribute yang diupload tidak diperbolehkan',
            'max' => 'Ukuran maksimal file ' . $setting['max_upload'] / 1000 . ' MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'status' => false,
            ], 302);
        } else {
            $data = [
                'id_participant' => $request->id_participant,
                'name' => $request->name,
            ];

            if (!empty($request->file)) {
                if ($request->id != null) {
                    $download = Document::find($request->id);
                    Helper::delete_file_aws($download->file);
                }

                $data = Helper::upload_aws($request, 'file', 'ppdb/image/document/', $data, '150|150', '150|150');
            }

            Document::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Data Dokumen berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function delete_document(Request $request)
    {
        $document = Document::find($request->id);
        $document->update(array('status' => 0));
        Helper::delete_aws($document->file);

        return response()->json([
            'message' => 'Data Dokumen berhasil dihapus',
            'status' => true,
        ], 200);
    }

    public function detail_document(Request $request)
    {
        // dd($request);
        $detail = Document::find($request->id);
        $file = null;
        if ($detail->file != null) {
            $file = Helper::showImage('thumb/' . $detail->file);
        }
        $detail['file'] = $file;
        return response()->json($detail);
    }

    public function update_status(Request $request)
    {
        Document::where('id', $request->id)->update(array('status' => $request->value));
        return response()->json([
            'message' => 'Dokumen berhasil diupdate',
            'status' => true,
        ], 200);
    }
}
