<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Auth;

class ParticipantController extends Controller
{

    public function index(Request $request)
    {
        session()->put('title', 'Akun Pendaftar');
        if ($request->ajax()) {
            $data = Participant::where('status', '!=', 0);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('master_registration.action', ['method' => 'add', 'name' => Str::slug($row['name']), 'code' => encrypt($row['id'])]) . '" class="mx-1"><i class="material-icons list-icon md-18 text-muted">person_add</i></a>';
                    $btn .= '<a href="' . route('participant.add', ['based' => 'edit', 'name' => Str::slug($row['name']), 'code' => encrypt($row['id'])]) . '" class="mx-1"><i class="material-icons list-icon md-18 text-muted">edit</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 reset_pass" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">verified_user</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 delete" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">delete</i></a>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    $img = '<img class="rounded" height="40" src="' . asset('asset/image/user.png') . '" alt="user">';
                    if ($row['file'] != 'user.png') {
                        $img = '<img class="rounded" width="55" src="' . asset($row->file) . '" alt="user">';
                    }
                    return $img;
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
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
        return view('content.admin.participant.v_account');
    }

    public function action()
    {
        $title = 'Tambah Akun Pendaftar';
        $participant = null;
        if ($_GET['based'] == 'edit') {
            $title = 'Edit Akun Pendaftar';
            $participant = Participant::find(decrypt($_GET['code']));
        }
        // dd($participant);
        session()->put('title', $title);
        return view('content.admin.participant.v_form', compact('participant'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Pendaftar',
            'place_of_birth' => 'Tempat Lahir',
        ];

        $setting = json_decode(Storage::get('settings.json'), true);
        $max_size = 'max:' . $setting['max_upload'];
        $mimes = 'mimes:' . $setting['format_image'];
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'latitude' => ['required', "regex:/^[0-9.-]+$/"],
            'longitude' => ['required', "regex:/^[0-9.-]+$/"],
        ];

        $messages = [
            'email' => ':attribute tidak valid.',
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
            if ($request->id) {
                $admin = Participant::find($request->id);
                $social = $admin->social;
            } else {
                $social = Str::of('' . $request->name . ' ' . Str::random(10) . '')->slug('-');
            }
            $data = [
                'name' => $request->name,
                'nisn' => $request->nisn,
                'phone' => $request->phone,
                'email' => $request->email,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => date('Y-m-d', strtotime($request->date_of_birth)),
                'gender' => $request->gender,
                'religion' => $request->religion,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'social' => $social,
            ];

            if ($request->hasFile('file')) {
                $data = ImageHelper::upload_asset($request, 'file', 'participant', $data);
            }

            Participant::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Data Pendaftar berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function delete(Request $request)
    {
        $participant = Participant::find($request->id);
        $participant->update(array('status' => 0));
        // Helper::delete_aws($participant->file);

        return response()->json([
            'message' => 'Pendaftar berhasil dihapus',
            'status' => true,
        ], 200);
    }

    public function detail(Request $request)
    {
        $detail = Participant::find($request->id);
        $file = asset('asset/image/user.png');
        if ($detail->file != 'user.png') {
            $file = asset('thumbnail/' . $detail->file);
        }
        $detail['file'] = $file;
        return response()->json($detail);
    }

    public function update_status(Request $request)
    {
        Participant::where('id', $request->id)->update(array('status' => $request->value));
        return response()->json([
            'message' => 'Pendaftar berhasil diupdate',
            'status' => true,
        ], 200);
    }

    public function reset_password(Request $request)
    {
        // dd($request);

        $customAttributes = [
            'password' => 'Password Baru',
            'confirm_password' => 'Password Konfirmasi',
        ];
        $rules = [
            'password' => ['required'],
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

            if ($request->password != $request->confirm_password) {
                return response()->json([
                    'message' => 'Maaf, Password yang anda inputkan tidak sama',
                    'status' => false,
                ], 302);
            } else {
                Participant::where('id', $request->id)->update(array('password' => Hash::make($request->password)));
                return response()->json([
                    'message' => 'Password Pendaftar berhasil diperbarui',
                    'status' => true,
                ], 200);
            }
        }
    }
}
