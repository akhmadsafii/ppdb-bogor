<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SettingTypeForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            // 'logo_school' => 'Logo Sekolah',
        ];

        $setting = json_decode(Storage::get('settings.json'), true);
        $max_size = 'max:' . $setting['max_upload'];
        $mimes = 'mimes:' . $setting['format_image'];

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
            'max' => 'Ukuran maksimal file ' . $setting['max_upload'] / 1000 . ' MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'status' => false,
            ], 302);
        } else {
            $status_open = 1;
            if ($request->status_open) {
                $status_open = 0;
            }
            $semester = '';
            if ($request->semester) {
                $semester = implode(',', $request->semester);
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
                'semester' => $semester,
            ];

            if ($request->hasFile('logo_school')) {
                $data = ImageHelper::upload_asset($request, 'logo_school', 'logo', $data);
                session()->put('logo_school', $data['logo_school']);
            }

            if ($request->hasFile('logo1')) {
                $data = ImageHelper::upload_asset($request, 'logo1', 'logo', $data);
            }

            if ($request->hasFile('logo2')) {
                $data = ImageHelper::upload_asset($request, 'logo2', 'logo', $data);
            }

            if ($request->hasFile('stamp')) {
                $data = ImageHelper::upload_asset($request, 'stamp', 'logo', $data);
            }

            if ($request->hasFile('signature_headmaster')) {
                $data = ImageHelper::upload_asset($request, 'signature_headmaster', 'logo', $data);
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
