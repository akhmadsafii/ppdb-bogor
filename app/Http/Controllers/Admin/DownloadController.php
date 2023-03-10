<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Brosur PPDB';
        if (request()->segment(3) == 'file') {
            $title = 'Dokumen PPDB';
        }
        session()->put('title', $title);
        if ($request->ajax()) {
            $data = Download::where([
                ['status', '!=', 0],
                ['type', '=', request()->segment(3)],
            ]);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="mx-1 edit" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">edit</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 delete" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">delete</i></a>';
                    return $btn;
                })
                ->editColumn('file', function ($row) {
                    if (request()->segment(3) == 'file') {
                        $infoPath = pathinfo($row['file']);
                        return '<a href="' . asset($row->file) . '" target="_blank">Lihat File </a>.' . $infoPath['extension'];
                    } else {
                        $img = '<img class="rounded" height="40" src="' . asset('asset/image/default.jpg') . '" alt="user">';
                        if ($row['file'] != null) {
                            $img = '<img class="rounded" width="55" src="' . asset($row->file) . '" alt="user">';
                        }
                        return $img;
                    }

                })
                ->editColumn('exstension', function ($row) {

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
                ->rawColumns(['action', 'file', 'status'])
                ->make(true);
        }
        return view('content.admin.download.v_download');
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama',
            'description' => 'Deskripsi',
        ];

        $max_size = 'max:' . env('SETTING_MAX_UPLOAD_IMAGE');
        $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_IMAGE'));
        if ($request->type == 'file') {
            $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_FILE'));
        }
        // dd($mimes);
        $image = ['file', $mimes, $max_size];
        if ($request->id == null) {
            $image = ['file', 'required', $mimes, $max_size];
        }
        $rules = [
            'file' => $image,
            'name' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'description' => ['required'],
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
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'type' => $request->type,
            ];
            if ($request->type == 'file') {
                if (!empty($request->file)) {
                    if ($request->id != null) {
                        $download = Download::find($request->id);
                        Helper::delete_file_aws($download->file);
                    }

                    $data = Helper::upload_file_aws($request, 'file', 'ppdb/file/download/', $data);
                }
            } else {
                if (!empty($request->file)) {
                    if ($request->id != null) {
                        $download = Download::find($request->id);
                        Helper::delete_aws($download->file);
                    }
                    $data = Helper::upload_aws($request, 'file', 'ppdb/image/download/', $data, '500|750', '500|750');
                }
            }
            Download::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Data berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function detail(Request $request)
    {
        // dd($request);
        $detail = Download::find($request->id);
        $file = null;
        if ($detail->file != null) {
            $file = asset('thumbnail/' . $detail->file);
        }
        $detail['file'] = $file;
        return response()->json($detail);
    }

    public function update_status(Request $request)
    {
        Download::where('id', $request->id)->update(array('status' => $request->value));
        return response()->json([
            'message' => 'Data berhasil diupdate',
            'status' => true,
        ], 200);
    }

    public function delete(Request $request)
    {
        $download = Download::find($request->id);
        $download->update(array('status' => 0));
        if ($download->type == 'file') {
            Helper::delete_file_aws($download->file);
        } else {
            Helper::delete_aws($download->file);
        }
        return response()->json([
            'message' => 'Data berhasil dihapus',
            'status' => true,
        ], 200);
    }
}
