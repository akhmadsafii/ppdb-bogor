<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Pengumuman');
        if ($request->ajax()) {
            $data = Announcement::where('status', '!=', 0);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="mx-1 edit" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">edit</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 delete" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">delete</i></a>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    $img = '<img class="rounded" height="40" src="' . asset('asset/image/default.jpg') . '" alt="user">';
                    if ($row['file'] != null) {
                        $img = '<a href="' . asset($row->file) . '" target="_blank"><img class="rounded" width="55" src="' . asset('thumbnail/' . $row->file) . '" alt="user"></a>';
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
        return view('content.admin.announcement.v_announcement');
    }

    public function participant(Request $request)
    {
        // dd('ping');
        session()->put('title', 'Dokumen');
        $participant = Participant::find(decrypt($_GET['key']));
        if ($request->ajax()) {
            $data = Document::with('participants')->where([
                ['id_participant', decrypt($_GET['key'])],
                ['status', '!=', 0]
            ]);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="mx-1 edit" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">edit</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 delete" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">delete</i></a>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    $img = '<img class="rounded" height="40" src="' . asset('asset/image/default.jpg') . '" alt="user">';
                    if ($row['file'] != null) {
                        $img = '<a href="' . Helper::showImage($row->file) . '" target="_blank"><img class="rounded" width="55" src="' . Helper::showImage('thumb/'.$row->file) . '" alt="user"></a>';
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
        return view('content.admin.document.v_document', compact('participant'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Document'
        ];

        $setting = json_decode(Storage::get('settings.json'), true);
        $max_size = 'max:' . $setting['max_upload'];
        $mimes = 'mimes:' . $setting['format_image'];

        $rules = [
            'file' => ['file', $mimes, $max_size],
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

                $data = Helper::upload_aws($request, 'file', 'ppdb/image/document/', $data, '150|150', 'null|null');
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

    public function delete(Request $request)
    {
        $document = Document::find($request->id);
        $document->update(array('status' => 0));
        Helper::delete_aws($document->file);

        return response()->json([
            'message' => 'Data Dokumen berhasil dihapus',
            'status' => true,
        ], 200);
    }

    public function update_status(Request $request)
    {
        Document::where('id', $request->id)->update(array('status' => $request->value));
        return response()->json([
            'message' => 'Dokumen berhasil diupdate',
            'status' => true,
        ], 200);
    }

    public function detail(Request $request)
    {
        // dd($request);
        $detail = Document::find($request->id);
        $file = null;
        if ($detail->file != null) {
            $file = Helper::showImage('thumb/'.$detail->file);
        }
        $detail['file'] = $file;
        return response()->json($detail);
    }
}
