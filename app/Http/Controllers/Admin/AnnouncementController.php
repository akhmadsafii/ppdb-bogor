<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Pengumuman');
        if ($request->ajax()) {
            $data = Announcement::where('status', '!=', 0);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="mx-1 detail" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">info</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 edit" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">edit</i></a>';
                    $btn .= '<a href="javascript:void(0)" class="mx-1 delete" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">delete</i></a>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    $img = '<img class="rounded" height="40" src="' . asset('asset/image/default.jpg') . '" alt="user">';
                    if ($row['file'] != null) {
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
        return view('content.admin.announcement.v_announcement');
    }

    public function store(Request $request)
    {
        $customAttributes = [
            'title' => 'Judul Pengumuman',
            'content' => 'Isi Pengumuman',
        ];

        $max_size = 'max:' . env('SETTING_MAX_UPLOAD_IMAGE');
        $mimes = 'mimes:' . str_replace('|', ',', env('SETTING_FORMAT_IMAGE'));
        $rules = [
            'file' => ['image', $mimes, $max_size],
            'title' => ['required', "regex:/^[a-zA-Z .,']+$/"],
            'content' => ['required'],
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
                'title' => $request->title,
                'code' => str_slug($request->title),
                'content' => $request->content,
                'status' => $request->status,
            ];

            if (!empty($request->file)) {
                if ($request->id != null) {
                    $announcement = Announcement::find($request->id);
                    Helper::delete_aws($announcement->file);
                }
                $data = Helper::upload_aws($request, 'file', 'ppdb/image/announcement/', $data, '750|400', '500|500');
            }
            Announcement::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Data Pengumuman berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function detail(Request $request)
    {
        $detail = Announcement::find($request->id);
        $file = null;
        if ($detail->file != null) {
            $file = asset($detail->file);
        }
        $detail['file'] = $file;
        return response()->json($detail);
    }

    public function delete(Request $request)
    {
        $announcement = Announcement::find($request->id);
        $announcement->update(array('status' => 0));
        Helper::delete_aws($announcement->file);
        return response()->json([
            'message' => 'Data Pengumuman berhasil dihapus',
            'status' => true,
        ], 200);
    }

    public function update_status(Request $request)
    {
        Announcement::where('id', $request->id)->update(array('status' => $request->value));
        return response()->json([
            'message' => 'Pengumuman berhasil diupdate',
            'status' => true,
        ], 200);
    }
}
