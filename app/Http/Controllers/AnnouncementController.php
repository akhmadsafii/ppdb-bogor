<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
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
        session()->put('title', 'Daftar Nilai Siswa');
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
                    $total_smt += (float)$sc->score;
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

        $result = array();
        foreach($registration as $k => $v) {
            $id = $v['id_participant'];
            $result[$id][] = $v['score_smt'];
        }

        $tes = [];
        // $result = [];
        foreach($registration as $key => $rg){
            $id = $rg['id_participant'];
            $tes[] = [
                'participant' => $rg['participant'],
                    'id_participant' => $rg['id_participant'],
                    'semester' => $rg['semester'],
                    'amount_smt' => $rg['amount_smt'],
                    'score_smt' => $rg['score_smt'],
                    'score' => $rg['score'],
                    'total' => array_sum($result[$id])
            ];
        }
        $full_registration = collect($tes)->sortByDesc('total');
        $registrations = Helper::paginate($full_registration, $amount_semester * 20)->setPath(route('public_score'));
        // dd($registrations);
        return view('content.public.v_score', compact('registrations', 'amount_semester', 'semester', 'course'));
    }
}
