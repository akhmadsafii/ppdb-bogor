<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\SettingTemplate;
use App\Models\SettingTypeForm;
use Illuminate\Http\Request;

class SettingTemplateController extends Controller
{
    public function index()
    {
        $title = 'Surat';
        if (request()->segment(4) == 'card') {
            $title = 'Kartu';
        }
        session()->put('title', $title);

        if(request()->segment(4) == 'letter'){
            $setting = SettingTemplate::where([
                ['status', 1],
                ['type', 'like', '%letter'],
            ])->get();
        }else{
            $setting = SettingTemplate::where([
                ['status', 1],
                ['type', request()->segment(4)],
            ])->get();
        }
        return view('content.admin.setting.v_setting_template', compact('setting'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $p = $request;
        for ($i = 1; $i <= $p['jumlah']; $i++) {
            $id_template = $p['id_setting_template_'.$i];
            $checkbox = $p['c_'.$i];
            $active = 0;
            if($checkbox){
                $active = 1;
            }
            $model = SettingTemplate::find($id_template);
            $model->active = $active;
            $model->save();
        }

        return response()->json([
            'message' => 'Setting Template berhasil disimpan',
            'status' => true,
        ], 200);
    }

    public function output_form()
    {
        session()->put('title', 'Pengaturan Form Kartu');
        $type = SettingTypeForm::with('forms')->get();
        return view('content.admin.setting.v_setting_card_form', compact('type'));
    }
}
