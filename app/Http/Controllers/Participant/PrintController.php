<?php

namespace App\Http\Controllers\Participant;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Registration;
use App\Models\RegistrationSchedule;
use App\Models\Setting;
use App\Models\SettingForm;
use App\Models\SettingTemplate;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PrintController extends Controller
{
    public function registration()
    {
        session()->put('title', 'Cetak Form Pendaftaran');
        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }
        $setting = Setting::first();
        $year = session('school_year');

        $kop_letter = [
            'header1' => empty($setting) ? null : (empty($setting->head1) ? null : $setting->head1),
            'header2' => empty($setting) ? null : (empty($setting->head2) ? null : $setting->head2),
            'header3' => empty($setting) ? null : (empty($setting->head3) ? null : $setting->head3),
            'address' => empty($setting) ? null : (empty($setting->address) ? null : $setting->address),
            'logo' => empty($setting) ? null : (empty($setting->logo1) ? null : Helper::showImage($setting->logo1)),
            'logo2' => empty($setting) ? null : (empty($setting->logo2) ? null : Helper::showImage($setting->logo2)),
        ];

        $set_form = SettingForm::where('status_form', 1)->orderBy('order_form', 'ASC')->get();

        $form_value = Registration::where([
            ['id_participant', Auth::guard('participant')->user()->id],
            ['school_year', 'like', "$year%"]
        ])->get();

        $col_form = collect($form_value);

        foreach ($set_form as $form) {
            $form_val = $col_form->where('id_form', $form->id)->first();
            $form_content[] = [
                'id' => $form->id,
                'name' => $form->name,
                'value' => empty($form_val) ? null : $form_val['value'],
            ];
        }

        $data = [
            'kop' => $kop_letter,
            'form' => $form_content
        ];
        // dd($data);
        if(request()->segment(4) == 'print'){
            $form_setting = SettingTemplate::where('type', 'like', 'letter%')->get();
            return view('content.participant.print.register.v_print_form', compact('data', 'form_setting'));
        }elseif(request()->segment(4) == 'pdf'){
            $form_setting = SettingTemplate::where('type', 'like', 'letter%')->get();
            $pdf   = PDF::loadview('content.participant.print.register.v_print_pdf', compact('data', 'form_setting'));
            return $pdf->stream();
        }else{
            return view('content.participant.print.register.v_register', compact('data'));
        }
    }

    public function card()
    {
        session()->put('title', 'Cetak Kartu Peserta');
        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }
        $setting = Setting::first();
        $kop = [
            'header1' => empty($setting) ? null : (empty($setting->head1) ? null : $setting->head1),
            'header2' => empty($setting) ? null : (empty($setting->head2) ? null : $setting->head2),
            'header3' => empty($setting) ? null : (empty($setting->head3) ? null : $setting->head3),
            'address' => empty($setting) ? null : (empty($setting->address) ? null : $setting->address),
            'logo' => empty($setting) ? null : (empty($setting->logo1) ? null : Helper::showImage($setting->logo1)),
            'logo2' => empty($setting) ? null : (empty($setting->logo2) ? null : Helper::showImage($setting->logo2)),
        ];

        $data_form = SettingForm::where('status_card', 1)->orderBy('order_card', 'ASC')->get();
        $year = session('school_year');
        $form_value = Registration::where([
            ['id_participant', Auth::guard('participant')->user()->id],
            ['school_year', 'like', "$year%"]
        ])->get();

        $col_form = collect($form_value);
        // dd($col_form);
        $form = [];
        foreach ($data_form as $dt_form) {
            // dd($form);
            $form_val = $col_form->where('id_form', $dt_form->id)->first();
            // dd($form_val);
            $form[] = [
                'id' => $dt_form->id,
                'name' => $dt_form->name,
                'value' => $form_val == null ? null : $form_val['value'],
            ];
            // dd($form);
        }
        // dd($form);

        $schedule = RegistrationSchedule::where('status', 1)->orderBy('sort', 'ASC')->get();
        $setting = SettingTemplate::where('type', 'card')->get();
        // dd($setting);
        if(request()->segment(4) == 'print'){
            return view('content.participant.print.card.v_print_card', compact('kop', 'form', 'schedule', 'setting'));
        }elseif(request()->segment(4) == 'pdf'){
            $pdf   = PDF::loadview('content.participant.print.card.v_print_pdf', compact('kop', 'form', 'schedule', 'setting'));
            return $pdf->stream();
        }else{
            return view('content.participant.print.card.v_card', compact('kop', 'form', 'schedule', 'setting'));
        }
    }

    public function announcement()
    {
        if (Helper::checkPayment() == false) {
            return view('content.participant.payment.v_notif');
        }
        $letter = [];
        $decision = [];
        $model = [];

        $setting = Setting::first();
        $template_letter = SettingTemplate::where([
            ['type', 'like', '%letter'],
            ['type', 'not like', 'participant-letter%'],
        ])->get();
        // dd($template_letter);

        $number_register = $this->get_initial('nomor_pendaftaran');
        $path_register = $this->get_initial('jalur_pendaftaran');
        $school_origin = $this->get_initial('asal_sekolah');

        $template_student = SettingTemplate::where('type', 'like', '%participant-letter')->get();
        // dd($template_student);
        foreach ($template_letter as $sur) {
            $val = null;
            if ($sur->initial == 'head1') {
                $val = $setting->head1;
            } elseif ($sur->initial == 'head2') {
                $val = $setting->head2;
            } elseif ($sur->initial == 'head3') {
                $val = $setting->head3;
            } elseif ($sur->initial == 'alamat') {
                $val = $setting->address;
            } elseif ($sur->initial == 'logo1') {
                $val = empty($setting->logo1) ? null : Helper::showImage('thumb/'.$setting->logo1);
            } elseif ($sur->initial == 'logo2') {
                $val = empty($setting->logo2) ? null : Helper::showImage('thumb/'.$setting->logo2);
            } elseif ($sur->initial == 'prolog') {
                $val = $setting->prologue;
            } elseif ($sur->initial == 'penutup') {
                $val = $setting->closing;
            } elseif ($sur->initial == 'ttd_kepsek') {
                $val = empty($setting->signature_headmaster) ? null : Helper::showImage('thumb/'.$setting->signature_headmaster);
            } elseif ($sur->initial == 'stempel') {
                $val = empty($setting->stamp) ? null : Helper::showImage('thumb/'.$setting->stamp);
            } elseif ($sur->initial == 'nip_kepsek') {
                $val = $setting->nip_headmaster;
            } elseif ($sur->initial == 'tempat_keputusan') {
                $val = $setting->decision_place;
            } elseif ($sur->initial == 'tahun_ajaran') {
                $val = $setting->school_year;
            } elseif ($sur->initial == 'nama_kepsek') {
                $val = $setting->name_headmaster;
            } elseif ($sur->initial == 'tgl_keputusan') {
                $val = $setting->decision_date;
            }

            $letter[] = [
                'id' => $sur->id,
                'type' => $sur->type,
                'initial' => $sur->initial,
                'name' => $sur->name,
                'active' => $sur->active,
                'value' => $val,
            ];
        }

        foreach ($template_student as $sis) {
            // dd($sis);
            $val1 = null;
            if ($sis->initial == 'nama') {
                $val1 = Auth::guard('participant')->user()->name;
            } elseif ($sis->initial == 'nisn') {
                $val1 = Auth::guard('participant')->user()->nisn;
            } elseif ($sis->initial == 'keputusan') {
                $val1 = Helper::decision(Auth::guard('participant')->user()->decision);
            } elseif ($sis->initial == 'keterangan_keputusan') {
                $val1 = Auth::guard('participant')->user()->decision_statement;
            } elseif ($sis->initial == 'no_pendaftaran') {
                $val1 = empty($number_register) ? null : (int)$number_register->value;
            } elseif ($sis->initial == 'jalur_pendaftaran') {
                $val1 = empty($path_register) ? null : $path_register->value;
            } elseif ($sis->initial == 'asal_sekolah') {
                $val1 = empty($school_origin) ? null : $school_origin->value;
            }

            $decision[] = [
                'id' => $sis->id,
                'type' => $sis->type,
                'initial' => $sis->initial,
                'name' => $sis->name,
                'active' => $sis->active,
                'value' => $val1,
            ];
        }

        $form = array_merge($letter, $decision);
        // dd($form);
        $setting_form = SettingTemplate::where('type', 'like', '%letter')->get();
        // dd($setting_form);
        if(request()->segment(4) == 'print'){
            return view('content.participant.print.result.v_print_result', compact('form', 'setting_form'));
        }elseif(request()->segment(4) == 'pdf'){
            // return view('content.participant.print.result.v_print_pdf', compact('form', 'setting_form'));
            $pdf   = PDF::loadview('content.participant.print.result.v_print_pdf', compact('form', 'setting_form'));
            return $pdf->stream();
        }else{
            return view('content.participant.print.result.v_result', compact('form', 'setting_form'));
        }
    }

    function get_initial($params){
        $result = DB::table('setting_forms as fs')
            ->join('registrations as pp', 'pp.id_form', '=', 'fs.id')
            ->join('participants as ps', 'ps.id', '=', 'pp.id_participant')
            ->where('fs.initial', '=', $params)
            ->where('pp.id_participant', Auth::guard('participant')->user()->id)
            ->select('pp.value')
            ->first();
        return $result;
    }
}
