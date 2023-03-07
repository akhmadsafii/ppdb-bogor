<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{
    public function edit()
    {
        session()->put('title', 'Ubah Profile');
        $participant = Participant::find(Auth::guard('participant')->user()->id);
        return view('content.participant.participant.v_my_account', compact('participant'));
    }

    public function update_profile(Request $request)
    {
        $customAttributes = [
            'name' => 'Nama Admin',
            'place_of_birth' => 'Tempat Lahir',
        ];

        $max_size = 'max:' . env('SETTING_MAX_UPLOAD_IMAGE');
        $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_IMAGE'));
        $rules = [
            'image' => ['file', 'image', $mimes, $max_size],
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
        ];

        $messages = [
            'email' => ':attribute tidak valid.',
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

            $participant = Participant::find(Auth::guard('participant')->user()->id);
            $data = [
                'name' => empty($request->name) ? $participant->name : $request->name,
                'email' => empty($request->email) ? $participant->email : $request->email,
                'phone' => empty($request->phone) ? $participant->phone : $request->phone,
                'religion' => empty($request->religion) ? $participant->religion : $request->religion,
                'gender' => empty($request->gender) ? $participant->gender : $request->gender,
                'place_of_birth' => empty($request->place_of_birth) ? $participant->place_of_birth : $request->place_of_birth,
                'date_of_birth' => empty($request->date_of_birth) ? $participant->date_of_birth : date('Y-m-d', strtotime($request->date_of_birth)),
                'address' => empty($request->address) ? $participant->address : $request->address,
            ];
            if (!empty($request->file)) {
                Helper::delete_aws($participant->file);
                $data = Helper::upload_aws($request, 'file', 'ppdb/image/profile/participant/', $data, '150|150', 'null|null');
            }
            $participant->update($data);

            return response()->json([
                'message' => 'Data Admin berhasil diupdate',
                'status' => true,
            ], 200);
        }

    }

    public function update_password(Request $request)
    {
        // dd($request);

        $customAttributes = [
            'current_password' => 'Password Baru',
            'confirm_password' => 'Password Konfirmasi',
        ];
        $rules = [
            'password' => ['required'],
            'current_password' => ['required'],
            'confirm_password' => ['required'],
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

            if (!Hash::check($request->password, Auth::guard('participant')->user()->password)) {
                return response()->json([
                    'message' => 'Maaf, Password yang anda inputkan tidak cocok dengan password anda saat ini',
                    'status' => false,
                ], 200);
            } else {
                if ($request->current_password == $request->confirm_password) {
                    Participant::where('id', Auth::guard('participant')->user()->id)->update(array('password' => Hash::make($request->confirm_password)));
                    return response()->json([
                        'message' => 'Password Pendaftar berhasil diperbarui',
                        'status' => true,
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Password baru anda tidak sama dengan konfirmasi password',
                        'status' => false,
                    ], 200);
                }
            }
        }
    }
}
