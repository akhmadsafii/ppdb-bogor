<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\ResponseMessage;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Pesan');
        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }
        $data = Message::with('participants', 'responses')->where([
            ['id_participant', Auth::guard('participant')->user()->id],
            ['status', '!=', 0]
        ])->latest()->get();
        // dd($data);
        if ($request->ajax()) {
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group" aria-label="Horizontal Button Group">';
                    $btn .= '<a href="' . route('participant.message.preview', ['message' => encrypt($row['id'])]) . '" class="mx-1 btn-purple btn-sm"><i class="material-icons list-icon md-18">speaker_notes</i></a>';
                    // if ($row['closed'] == 0) {
                    //     $btn .= '<a href="javascript:void(0)" class="mx-1 closed btn-warning btn-sm" data-id="' . $row->id . '"><i class="material-icons list-icon md-18">close</i></a>';
                    // }
                    $btn .= '<a href="javascript:void(0)" class="mx-1 delete btn-danger btn-sm" data-id="' . $row->id . '"><i class="material-icons list-icon md-18">delete</i></a>';
                    $btn .= '</div>';
                    return $btn;
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
                ->editColumn('name_participant', function ($row) {
                    return 'Administrator';
                })
                ->editColumn('response', function ($row) {
                    return $row->responses->count();
                })
                ->editColumn('session', function ($row) {
                    if ($row['closed'] == 0) {
                        return '<span class="alert alert-success">Dibuka</span>';
                    } else {
                        return '<span class="alert alert-danger">Ditutup</span>';
                    }
                })
                ->rawColumns(['action', 'status', 'name_participant', 'session', 'response'])
                ->make(true);
        }
        return view('content.participant.message.v_message');
    }

    public function preview()
    {
        session()->put('title', 'Detail Pesan');
        $message = Message::with('participants')->find(decrypt($_GET['message']));
        $response = ResponseMessage::with('participants', 'admins')->where('id_message', decrypt($_GET['message']))->latest()->get();
        return view('content.participant.message.v_preview_message', compact('message', 'response'));
    }

    public function store(Request $request)
    {
        $customAttributes = [
            'name' => 'Judul Pesan',
        ];

        $setting = json_decode(Storage::get('settings.json'), true);
        $max_size = 'max:' . $setting['max_upload'];
        $mimes = 'mimes:' . $setting['format_image'];

        $rules = [
            'file' => ['image', $mimes, $max_size],
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
                'id_participant' => Auth::guard('participant')->user()->id,
                'name' => $request->name,
                'content' => $request->content,
            ];
            if (!empty($request->file)) {
                if ($request->id != null) {
                    $message = Message::find($request->id);
                    Helper::delete_aws($message->file);
                }
                $data = Helper::upload_aws($request, 'file', 'ppdb/image/message/', $data, 'null|null', '150|150');
            }
            Message::updateOrCreate(
                ['id' => $request->id],
                $data
            );
        }
        return response()->json([
            'message' => 'Pesan berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function detail(Request $request)
    {
        $message = Message::with('participants')->find($request['id']);
        $file = null;
        if ($message['file'] != null) {
            $file = Helper::showImage('thumb/' . $message['file']);
        }
        $message['file'] = $file;
        return response()->json($message);
    }

    public function closed(Request $request)
    {
        $message = Message::find($request->id);
        $message->update(array('closed' => 1));
        return response()->json([
            'message' => 'Pesan berhasil ditutup',
            'status' => true,
        ], 200);
    }

    public function delete(Request $request)
    {
        $message = Message::find($request->id);
        $message->update(array('status' => 0));
        Helper::delete_aws($message->file);
        return response()->json([
            'message' => 'Pesan berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
