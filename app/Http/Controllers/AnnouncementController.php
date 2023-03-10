<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Registration;
use App\Models\Setting;
use App\Models\SettingForm;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index()
    {
        session()->put('title', 'Pengumuman');
        $announcement = Announcement::where('status', 1)->get();
        return view('content.public.v_announcement', compact('announcement'));
    }

    public function preview()
    {
        $announcement = Announcement::where('code', $_GET['title'])->first();
        // dd($announcement);
        $announcement->update(['viewer' => $announcement->viewer + 1]);
        return view('content.public.v_detail_announcement', compact('announcement'));
    }

    public function score()
    {
        $setting = Setting::first();
        $semester = [];
        $amount_semester = 1;
        if ($setting && $setting['semester']) {
            $semester = explode(',', $setting['semester']);
            $amount_semester = count($semester);
        }
        $list_mapel = Registration::join('setting_forms as sf', 'sf.id', '=', 'registrations.id_form')
            ->join('setting_type_forms as stf', 'stf.id', '=', 'sf.id_type')
            ->where('stf.initial', 'nilai_mapel_raport')
            ->where(function ($query) use ($semester) {
                foreach ($semester as $keyword) {
                    $query->orWhere('sf.initial', 'like', '%semester_' . $keyword . '%');
                }
            })
            ->select('sf.initial as initial', 'sf.name as course')->groupBy('initial', 'course')->get();
        $mapel = [];
        foreach ($list_mapel as $mp) {
            $mapel[] = trim(substr($mp['course'], 0, -17));
        }
        $course = array_unique($mapel);
        // $registration = Registration::join('setting_forms as sf', 'sf.id', '=', 'registrations.id_form')
        //     ->join('setting_type_forms as stf', 'stf.id', '=', 'sf.id_type')
        //     ->join('participants as pr', 'pr.id', '=', 'registrations.id_participant')
        //     ->where('stf.initial', 'nilai_mapel_raport')
        //     ->where(function ($query) use ($semester) {
        //         foreach ($semester as $keyword) {
        //             $query->orWhere('sf.initial', 'like', '%semester_' . $keyword);
        //         }
        //     })
        //     ->select('registrations.value as score', 'pr.name as participant', 'sf.name as course',  DB::raw('substr(sf.initial, -1) as semester'))->orderBy('participant')->orderBy('semester')->get();
        // dd($registration);
        $participants = Registration::join('participants as pr', 'pr.id', '=', 'registrations.id_participant')
            ->select('pr.id as id_participant', 'pr.name as participant')
            ->groupBy('pr.id', 'pr.name')->get();
        $registration = [];

        foreach ($participants as $participant) {
            // $list_score = [];
            foreach ($semester as $smt) {

                $score = Registration::join('setting_forms as sf', 'sf.id', '=', 'registrations.id_form')
                    ->join('setting_type_forms as stf', 'stf.id', '=', 'sf.id_type')
                    ->join('participants as pr', 'pr.id', '=', 'registrations.id_participant')
                    ->where('stf.initial', 'nilai_mapel_raport')
                    ->where('pr.id', $participant->id_participant)
                    ->where(function ($query) use ($smt) {
                        $query->orWhere('sf.initial', 'like', '%semester_' . $smt);
                    })
                    ->select('registrations.value as score', 'pr.name as participant', 'pr.id as id_participant', 'sf.name as course')->get();
                // $list_score[] =
                $list = [];
                $total_smt = 0;
                foreach ($score as $sc) {
                    $total_smt += $sc->score;
                    $list[] = [
                        'semester' => $smt,
                        'score' => $sc->score,
                        'course' => $sc->course,
                        'participant' => $sc->participant,
                        'id_participant' => $sc->id_participant,
                    ];
                }
                // $score_smt = collect($list)->pluck('score');
                $registration[] = [
                    'participant' => $participant->participant,
                    'id_participant' => $participant->id_participant,
                    'semester' => $smt,
                    'amount_smt' => count($semester),
                    'score_smt' => $total_smt,
                    'score' => $list,
                ];
            }
        }

        $temp = [];
        foreach ($registration as $value) {
            if (!array_key_exists($value['id_participant'], $temp)) {
                $temp[$value['id_participant']] = 0;
            }
            //Add up the values from each color
            $temp[$value['id_participant']] += $value['score_smt'];
        }
        // dd($temp[1]);
        // $tes = $registration->paginate(1);
        // dd(array_merge_recursive($registration, $temp));
        return view('content.public.v_score', compact('registration', 'amount_semester', 'semester', 'course', 'temp'));
    }
}
