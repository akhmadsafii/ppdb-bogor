<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class ResponseMessageController extends Controller
{
    public function store(Request $request)
    {
        $customAttributes = [
            'content' => 'Pesan'
        ];
        $rules = [
            'content' => ['required'],
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

            if (Auth::guard('admin')->check()) {
                $profile = Auth::guard('admin')->user();
                $role = 'admin';
            } elseif (Auth::guard('participant')->check()) {
                $profile = Auth::guard('participant')->user();
                $role = 'participant';
            }

            $data = [
                'id_message' => $request->id_message,
                'content' => $request->content,
                'role' => $role,
                'social' => $profile->social
            ];
            ResponseMessage::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Tanggapan berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }
}
