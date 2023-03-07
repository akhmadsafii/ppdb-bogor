<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingForm;
use App\Models\SettingTypeForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Data Form');
        $type = SettingTypeForm::where('status', 1)->get();
        if ($request->ajax()) {
            $data = SettingForm::with('types')->where('status', '!=', 0);
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
                ->editColumn('type_form', function ($row) {
                    return $row->types->name;
                })
                ->rawColumns(['action', 'status', 'type_form'])
                ->make(true);
        }
        return view('content.admin.form.v_form', compact('type'));
    }

    public function sort_number()
    {
        session()->put('title', 'Urutkan Form');
        $form = SettingForm::where([
            ['id_type', 1],
            ['status', 1]
        ])->orderBy('order_form', 'ASC')->get();
        // dd($form);
        return view('content.admin.form.v_sort_number', compact('form'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $customAttributes = [
            'name' => 'Nama Form',
            'type' => 'Pilihan Tipe',
            'id_type' => 'Pilihan Jenis',
        ];
        $rules = [
            'name' => ['required'],
            'type' => ['required'],
            'id_type' => ['required'],
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
            $data = [
                'name' => $request->name,
                'id_type' => $request->id_type,
                'type' => $request->type,
                'initial' => Str::slug($request->name, '_'),
                'status' => $request->status ?? 1,
            ];
            SettingForm::updateOrCreate(
                ['id' => $request->id],
                $data
            );
            return response()->json([
                'message' => 'Settingan Form berhasil disimpan',
                'status' => true,
            ], 200);
        }
    }

    public function detail(Request $request)
    {
        $detail = SettingForm::find($request->id);
        return response()->json($detail);
    }

    public function update_status(Request $request)
    {
        SettingForm::where('id', $request->id)->update(array('status' => $request->value));
        return response()->json([
            'message' => 'Settingan Form berhasil diupdate',
            'status' => true,
        ], 200);
    }

    public function update_number(Request $request)
    {
        $p = $request;
        for ($i = 1; $i < $p['total_form']; $i++) {
            if ($p['sort_' . $i]) {
                $model = SettingForm::find($p['id_form_' . $i]);
                $model->order_form = $p['sort_' . $i];
                $model->save();
            }
        }
        return response()->json([
            'message' => 'Urutan Form berhasil diupdate',
            'status' => true,
        ], 200);
    }

    public function update_checked(Request $request)
    {
        $p = $request;
        for ($i = 1; $i <= $p['total_type']; $i++) {
            for ($c = 1; $c <= $p['total_form_type_' . $i]; $c++) {
                $status = 0;
                if ($p['form_type_' . $i . '_number_' . $c]) {
                    $status = $p['form_type_' . $i . '_number_' . $c];
                }
                $model = SettingForm::find($p['id_form_type_' . $i . '_number_' . $c]);
                $model->status_form = $status;
                $model->save();
            }
        }
        return response()->json([
            'message' => 'Form berhasil diupdate',
            'status' => true,
        ], 200);
    }

    public function update_card_checked(Request $request)
    {
        $p = $request;
        for ($i = 1; $i <= $p['total_type']; $i++) {
            for ($c = 1; $c <= $p['total_form_type_' . $i]; $c++) {
                $status = 0;
                if ($p['form_type_' . $i . '_number_' . $c]) {
                    $status = $p['form_type_' . $i . '_number_' . $c];
                }
                $model = SettingForm::find($p['id_form_type_' . $i . '_number_' . $c]);
                $model->status_card = $status;
                $model->save();
            }
        }
        return response()->json([
            'message' => 'Form berhasil diupdate',
            'status' => true,
        ], 200);
    }
}
