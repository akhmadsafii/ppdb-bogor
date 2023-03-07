<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SettingTypeForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        session()->put('title', 'PPDB');
        $setting = Setting::first();
        // dd($setting);
        return view('content.admin.setting.v_setting', compact('setting'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'head1' => 'Heading Pesan',
            'signature_headmaster' => 'Tanda tangan Kepala Sekolah',
            'stamp' => 'Gambar Stempel',
        ];

        $max_size = 'max:' . env('SETTING_MAX_UPLOAD_IMAGE');
        $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_IMAGE'));
        // dd($mimes);
        $rules = [
            'logo1' => ['image', $mimes, $max_size],
            'logo2' => ['image', $mimes, $max_size],
            'stamp' => ['image', $mimes, $max_size],
            'logo_school' => ['image', $mimes, $max_size],
            'signature_headmaster' => ['image', $mimes, $max_size],
            'head1' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'name_school' => ['required'],
            'name_program' => ['required'],
        ];

        $messages = [
            'required' => ':attribute harus diisi.',
            'mimes' => 'Format tipe gambar :attribute yang diupload tidak diperbolehkan',
            'max' => 'Ukuran maksimal file ' . env('SETTING_MAX_UPLOAD_IMAGE') / 1000 . ' MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'status' => false,
            ], 302);
        } else {
            $status_open = 1;
            if($request->status_open){
                $status_open = 0;
            }

            $data = [
                'name_school' => $request->name_school,
                'name_program' => $request->name_program,
                'head1' => $request->head1,
                'head2' => $request->head2,
                'head3' => $request->head3,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'max_distance' => $request->max_distance,
                'prologue' => $request->prologue,
                'closing' => $request->closing,
                'name_headmaster' => $request->name_headmaster,
                'login_requirement' => $request->login_requirement,
                'decision_place' => $request->decision_place,
                'decision_date' => date('Y-m-d', strtotime($request->decision_date)),
                'open_date' => date('Y-m-d H:i', strtotime($request->open_date)),
                'school_year' => $request->school_year,
                'status_open' => $status_open,
                'closing_date' => date('Y-m-d', strtotime($request->closing_date)),
                'closing_hour' => $request->closing_hour,
                'major' => $request->major,
                'track_ppdb' => $request->track_ppdb,
                'copyright' => $request->copyright,
                'quota' => $request->quota,
                'auto_number' => $request->auto_number,
                'whatsapp' => $request->whatsapp,
                'phone' => $request->phone,
                'degree' => $request->degree,
                'nip_headmaster' => $request->nip_headmaster,
            ];

            if ($request->id != null) {
                $setting = Setting::find($request->id);
            }

            if (!empty($request->logo_school)) {
                if ($request->id != null) {
                    Helper::delete_aws($setting->logo1);
                }
                $data = Helper::upload_aws($request, 'logo_school', 'ppdb/image/setting/', $data, 'null|null', 'null|null');
            }

            if (!empty($request->logo1)) {
                if ($request->id != null) {
                    Helper::delete_aws($setting->logo1);
                }
                $data = Helper::upload_aws($request, 'logo1', 'ppdb/image/setting/', $data, 'null|null', 'null|null');
            }
            if (!empty($request->logo2)) {
                if ($request->id != null) {
                    Helper::delete_aws($setting->logo2);
                }
                $data = Helper::upload_aws($request, 'logo2', 'ppdb/image/setting/', $data, 'null|null', 'null|null');
            }
            if (!empty($request->stamp)) {
                if ($request->id != null) {
                    Helper::delete_aws($setting->stamp);
                }
                $data = Helper::upload_aws($request, 'stamp', 'ppdb/image/setting/', $data, 'null|null', 'null|null');
            }
            if (!empty($request->signature_headmaster)) {
                if ($request->id != null) {
                    Helper::delete_aws($setting->signature_headmaster);
                }
                $data = Helper::upload_aws($request, 'signature_headmaster', 'ppdb/image/setting/', $data, 'null|null', 'null|null');
            }
            Setting::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            session()->put('school_year', $request->school_year);
            return response()->json([
                'message' => 'Setting berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function type_form()
    {
        $type = SettingTypeForm::with('forms')->get();
        // dd($type);
        return view('content.admin.setting.v_setting_form', compact('type'));


    }
}
