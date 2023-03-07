<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingTypeForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class TypeFormController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Jenis Form');
        if ($request->ajax()) {
            $data = SettingTypeForm::where('status', '!=', 0);
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="mx-1 edit" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">edit</i></a>';
                    // $btn .= '<a href="javascript:void(0)" class="mx-1 delete" data-id="' . $row->id . '"><i class="material-icons list-icon md-18 text-muted">delete</i></a>';
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
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('content.admin.type_form.v_type_form');
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Jenis',
        ];
        $rules = [
            'name' => ['required'],
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
            $initial = Str::slug($request->name, '_');
            if($request->id){
                if($request->id == 1){
                    $initial = 'form_setting';
                }
            }else{
                if($request->name == 'Setting Form Pendaftaran'){
                    $initial = 'form_setting';
                }
            }
            $data = [
                'name' => $request->name,
                'initial' => $initial,
                'status' => $request->status ?? 1,
            ];
            SettingTypeForm::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Jenis Form berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function detail(Request $request)
    {
        $detail = SettingTypeForm::find($request->id);
        return response()->json($detail);
    }

    public function update_status(Request $request)
    {
        SettingTypeForm::where('id', $request->id)->update(array('status' => $request->value));
        return response()->json([
            'message' => 'Jenis Form berhasil diupdate',
            'status' => true,
        ], 200);
    }

    public function setting()
    {

    }
}
