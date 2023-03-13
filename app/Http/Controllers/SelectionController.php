<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Registration;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SelectionController extends Controller
{
    public function index(Request $request)
    {
        session()->put('title', 'Hasil Seleksi PPDB');
        $setting = Setting::first();
        $year = empty($setting) ? null : (empty($setting->school_year) ? null : $setting->school_year);
        $fix_year = $request->school_year ?? $year;
        $registration = Registration::where('school_year', $fix_year)->get();
        $participant_registration = $registration->pluck('id_participant');
        $participant = Participant::whereIn('id', $participant_registration)->where('decision', 1)->get();
        $data = [];
        foreach ($participant as $prt) {
            $school_origin = collect($registration)->where('id_participant', $prt->id)->where('id_form', 49)->first();
            if($school_origin){
                $school = $school_origin['value'];
            }else{
                $school = NULL;
            }

            $data[] = array(
                'name' => $prt->name,
                'nisn' => $prt->nisn,
                'school_origin' => $school,
            );
        }
        // dd($data);
        if ($request->ajax()) {
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
        return view('content.public.v_selection');
    }
}
