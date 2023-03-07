<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
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
        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }
        if ($request->ajax()) {
            $data = Download::where([
                ['status', '!=', 0],
                ['type', '=', request()->segment(3)],
            ]);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . Helper::showImage($row->file) . '" target="_blank" class="mx-1"><i class="material-icons list-icon md-18 text-muted">file_download</i></a>';
                    return $btn;
                })
                ->editColumn('file', function ($row) {
                    if (request()->segment(3) == 'file') {
                        $infoPath = pathinfo($row['file']);
                        return str_slug($row['name'], '-').'.' . $infoPath['extension'];
                    } else {
                        $img = '<img class="rounded" height="40" src="' . asset('asset/image/default.jpg') . '" alt="user">';
                        if ($row['file'] != null) {
                            $img = '<a href="' . Helper::showImage($row->file) . '" target="_blank"><img class="rounded" width="55" src="' . Helper::showImage('thumb/' . $row->file) . '" alt="user"></a>';
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
        return view('content.participant.download.v_download');
    }
}
