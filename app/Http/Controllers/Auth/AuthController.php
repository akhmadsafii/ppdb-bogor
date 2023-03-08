<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        $setting = Setting::first();
        // dd($setting);
        return view('auth.v_login', compact('setting'));
    }

    public function verify(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt($this->admin_credentials($request), $request->filled('remember'))) {
            return redirect()->intended(route('dashboard-admin'));
        } else if (Auth::guard('participant')->attempt($this->participant_credentials($request), $request->filled('remember'))) {
            return redirect()->intended(route('participant.dashboard-participant'));
        }
        return redirect()->back()->withInput()->withErrors(['msg' => 'Anda tidak mempunyai akses untuk login']);
    }

    protected function admin_credentials(Request $request)
    {
        if (is_numeric($request->get('username'))) {
            return ['phone' => $request->get('username'), 'password' => $request->get('password'), 'status' => 1];
        } elseif (filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('username'), 'password' => $request->get('password'), 'status' => 1];
        }
        return ['username' => $request->get('username'), 'password' => $request->get('password'), 'status' => 1];
    }

    protected function participant_credentials(Request $request)
    {
        if (is_numeric($request->get('username'))) {
            return ['phone' => $request->get('username'), 'password' => $request->get('password')];
        } elseif (filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('username'), 'password' => $request->get('password')];
        }
        return ['nisn' => $request->get('username'), 'password' => $request->get('password')];
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('participant')->check()) {
            Auth::guard('participant')->logout();
        }

        return redirect()->route('auth.login');
    }

    public function verifyRegister(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Pendaftar',
            'gender' => 'Jenis Kelamin',
            'phone' => 'Nomor Telepon',
        ];

        $rules = [
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'nisn' => ['required'],
            'gender' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            // 'longitude' => ['required'],
            // 'latitude' => ['required'],
        ];

        $messages = [
            'email' => ':attribute tidak valid.',
            'required' => ':attribute harus diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $social = Str::of('' . $request->name . ' ' . Str::random(10) . '')->slug('-');
            $data = [
                'name' => $request->name,
                'nisn' => $request->nisn,
                'phone' => $request->phone,
                'email' => $request->email,
                'gender' => $request->gender,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'social' => $social,
            ];

            Participant::create(
                $data
            );
            return redirect()->back()->withSuccess('Pendaftaran anda berhasil!, Silahkan login menggunakan akun yang telah anda daftarkan');
        }
    }
}
