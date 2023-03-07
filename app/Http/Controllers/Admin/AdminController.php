<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Akun Admin');
        if ($request->ajax()) {
            $data = Admin::where('status', '!=', 0);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group" aria-label="Horizontal Button Group">';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 detail btn btn-purple btn-sm" data-id="' . $row->id . '"><i class="material-icons list-icon md-18">info</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 edit btn-info btn-sm" data-id="' . $row->id . '"><i class="material-icons list-icon md-18">edit</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 delete btn-danger btn-sm" data-id="' . $row->id . '"><i class="material-icons list-icon md-18">delete</i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    $img = '<img class="rounded" height="40" src="' . asset('asset/image/user.png') . '" alt="user">';
                    if ($row['file'] != 'user.png') {
                        $img = '<a href="' . Storage::disk('s3')->temporaryUrl($row->file, '+2 minutes') . '" target="_blank"><img class="rounded" width="55" src="' . Storage::disk('s3')->temporaryUrl('thumb/' . $row->file, '+2 minutes') . '" alt="user"></a>';
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
        return view('content.admin.admin.v_admin');
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Admin',
            'place_of_birth' => 'Tempat Lahir',
        ];

        $max_size = 'max:' . env('SETTING_MAX_UPLOAD_IMAGE');
        $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'username' => ['required', "regex:/^[a-zA-Z .,']+$/"],
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
            if ($request->id) {
                $admin = Admin::find($request->id);
                $social = $admin->social;
            } else {
                $social = Str::of('' . $request->name . ' ' . Str::random(10) . '')->slug('-');
            }
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'social' => $social,
            ];
            if (!empty($request->file)) {
                if ($request->id != null) {
                    $admin = Admin::find($request->id);
                    Helper::delete_aws($admin->file);
                }
                $data = Helper::upload_aws($request, 'file', 'ppdb/image/profile/admin/', $data, '150|150', '200|200');
            }
            Admin::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Data Admin berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function detail(Request $request)
    {
        $detail = Admin::find($request->id);
        $file = Storage::disk('s3')->temporaryUrl('thumb/' . $detail->file, '+2 minutes');
        if ($detail->file == null || $detail->file == 'user.png') {
            $file = asset('asset/image/user.png');
        }
        $detail['file'] = $file;
        return response()->json($detail);
    }

    public function delete(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->update(array('status' => 0));
        Helper::delete_aws($admin->file);
        return response()->json([
            'message' => 'Admin berhasil dihapus',
            'status' => true,
        ], 200);
    }

    public function update_status(Request $request)
    {
        Admin::where('id', $request->id)->update(array('status' => $request->value));
        return response()->json([
            'message' => 'Admin berhasil diupdate',
            'status' => true,
        ], 200);
    }

    public function edit()
    {
        session()->put('title', 'Ubah Profile');
        $admin = Admin::find(Auth::guard('admin')->user()->id);
        return view('content.admin.admin.v_my_account', compact('admin'));
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

            $admin = Admin::find(Auth::guard('admin')->user()->id);
            $data = [
                'name' => empty($request->name) ? $admin->name : $request->name,
                'email' => empty($request->email) ? $admin->email : $request->email,
                'phone' => empty($request->phone) ? $admin->phone : $request->phone,
                'religion' => empty($request->religion) ? $admin->religion : $request->religion,
                'gender' => empty($request->gender) ? $admin->gender : $request->gender,
                'place_of_birth' => empty($request->place_of_birth) ? $admin->place_of_birth : $request->place_of_birth,
                'date_of_birth' => empty($request->date_of_birth) ? $admin->date_of_birth : $request->date_of_birth,
                'address' => empty($request->address) ? $admin->address : $request->address,
            ];
            if (!empty($request->file)) {
                Helper::delete_aws($admin->file);
                $data = Helper::upload_aws($request, 'file', 'ppdb/image/profile/admin/', $data, '150|150', 'null|null');
            }
            $admin->update($data);

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

            if (!Hash::check($request->password, Auth::guard('admin')->user()->password)) {
                return response()->json([
                    'message' => 'Maaf, Password yang anda inputkan tidak cocok dengan password anda saat ini',
                    'status' => false,
                ], 200);
            } else {
                if ($request->current_password == $request->confirm_password) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(array('password' => Hash::make($request->confirm_password)));
                    return response()->json([
                        'message' => 'Password Admin berhasil diperbarui',
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
