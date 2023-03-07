<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Participant;
use App\Models\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Pesan');
        $data = Message::with('participants')->where('status', '!=', 0)->latest()->get();
        // dd($data);
        if ($request->ajax()) {
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group" aria-label="Horizontal Button Group">';
                    $btn .= '<a href="' . route('message.preview', ['message' => encrypt($row['id'])]) . '" class="mx-1 btn-purple btn-sm"><i class="material-icons list-icon md-18">speaker_notes</i></a>';
                    if ($row['closed'] == 0) {
                        // $btn .= '<a href="javascript:void(0)" class="mx-1 edit btn-info btn-sm" data-id="' . $row->id . '"><i class="material-icons list-icon md-18">edit</i></a>';
                        $btn .= '<a href="javascript:void(0)" class="mx-1 closed btn-warning btn-sm" data-id="' . $row->id . '"><i class="material-icons list-icon md-18">close</i></a>';
                    }
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
                    return $row->participants->name;
                })
                ->editColumn('session', function ($row) {
                    if ($row['closed'] == 0) {
                        return '<span class="alert alert-success">Dibuka</span>';
                    } else {
                        return '<span class="alert alert-danger">Ditutup</span>';
                    }
                })
                ->rawColumns(['action', 'status', 'name_participant', 'session'])
                ->make(true);
        }
        return view('content.admin.message.v_message');
    }

    public function store(Request $request)
    {
        // dd($request);

        foreach (json_decode($request['id_participant']) as $key) {
            $customAttributes = [
                'name' => 'Judul Pesan',
            ];

            $max_size = 'max:' . env('SETTING_MAX_UPLOAD_IMAGE');
            $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_IMAGE'));
            $rules = [
                'file' => ['image', $mimes, $max_size],
                'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
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
                $data = [
                    'id_participant' => $key,
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
        }
        return response()->json([
            'message' => 'Pesan berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function update(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Judul Pesan',
        ];

        $max_size = 'max:' . env('SETTING_MAX_UPLOAD_IMAGE');
        $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
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
            $data = [
                'id_participant' => $request->id_participants,
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

    public function get_participant()
    {
        $result = Participant::where('status', '!=', 0)->get();
        $table = datatables()->of($result)
            ->addColumn('action', function ($data) {
                $button = '<button type="button" data-id="' . $data['id'] . '" class="delete btn btn-danger btn-sm m-1"><i class="fas fa-trash-alt"></i></button>';
                $button .= '<a href="javascript:void(0)" data-id="' . $data['id'] . '" class="edit btn btn-info btn-sm m-1"><i class="fas fa-edit"></i></a>';
                return $button;
            });
        $table->editColumn('check', function ($row) {
            return '<input type="checkbox" class="check_participant" value="' . $row['id'] . '" />';
        });
        $table->rawColumns(['action', 'check']);
        $table->addIndexColumn();

        return $table->make(true);
    }

    public function preview()
    {
        session()->put('title', 'Detail Pesan');
        $message = Message::with('participants')->find(decrypt($_GET['message']));
        $response = ResponseMessage::with('participants', 'admins')->where('id_message', decrypt($_GET['message']))->latest()->get();
        // dd($response);
        return view('content.admin.message.v_preview_message', compact('message', 'response'));
    }
}
