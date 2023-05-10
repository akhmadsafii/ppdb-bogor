<?php

namespace App\Helpers;

use App\Models\Participant;
use App\Models\PaymentParticipant;
use App\Models\Setting;
use App\Models\SettingPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;
use Auth;

class Helper
{
    public static function check_and_make_dir($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    public static function envUpdate($old, $new)
    {
        $path = base_path('.env');
        $test = file_get_contents($path);

        if (file_exists($path)) {
            file_put_contents($path, str_replace($old, $new, $test));
        }
    }

    public static function upload_image($request, $name, $path, $data)
    {
        $file = $request->file($name);
        $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $resolusi = explode('|', env('SETTING_RESOLUTION'));
        $thumb = Image::make($file->getRealPath())->resize($resolusi[0], $resolusi[1], function ($constraint) {
            $constraint->aspectRatio();
        });
        $destinationPath = public_path($path);
        Helper::check_and_make_dir($destinationPath);
        $path_thumbail = 'thumbnail/' . $path;
        $destinationPathThumbnail = public_path($path_thumbail);
        Helper::check_and_make_dir($destinationPathThumbnail);
        $file->move($destinationPath, $profileImage);
        $thumb->save($destinationPathThumbnail . $profileImage);
        $data[$name] = $path . "/" . $profileImage;
        return $data;
    }

    public static function upload_file($request, $name, $path, $data)
    {
        $file = $request->file($name);
        $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $destinationPath = public_path($path);
        Helper::check_and_make_dir($destinationPath);
        $file->move($destinationPath, $profileImage);
        $data[$name] = $path . "/" . $profileImage;
        return $data;
    }

    public static function upload_aws($request, $name, $path, $data, $ratio, $resolution)
    {
        $file = $request->file($name);
        $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
        Storage::disk('s3')->put($path . $profileImage, file_get_contents($file));
        $thumb = 'thumb/' . $path;

        $img = Image::make($file);
        $resolution = explode('|', $resolution);
        $img->resize($resolution[0], $resolution[1], function ($constraint) {
            $constraint->aspectRatio();
        });
        $resource = $img->stream()->detach();
        $ratio = explode('|', $ratio);
        // dd($ratio[0]);
        if ($ratio[0] != 'null') {
            $image_thumb = Image::make($resource)->crop($ratio[0], $ratio[1]);
            $image_thumb = $image_thumb->stream();
        } else {
            // dd($resource);
            $image_thumb = Image::make($resource);
            $image_thumb = $image_thumb->stream();
            // $image_thumb = $resource->stream();
        }
        // dd($image_thumb);
        Storage::disk('s3')->put($thumb . $profileImage, $image_thumb->__toString());
        $data[$name] = $path . $profileImage;
        return $data;
    }

    public static function upload_file_aws($request, $name, $path, $data)
    {
        $file = $request->file($name);
        $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
        Storage::disk('s3')->put($path . $profileImage, file_get_contents($file));
        $data[$name] = $path . $profileImage;
        return $data;
    }

    public static function delete_aws($path)
    {
        Storage::disk('s3')->delete($path);
        Storage::disk('s3')->delete('thumb/' . $path);
    }

    public static function delete_file_aws($path)
    {
        Storage::disk('s3')->delete($path);
    }

    public static function formatMonth($param)
    {
        $value = Carbon::parse($param)->translatedFormat('d F Y');
        return $value;
    }

    public static function formatMonthYear($param)
    {
        $value = Carbon::parse($param)->translatedFormat('F Y');
        return $value;
    }

    public static function formatDay($param)
    {
        $value = Carbon::parse($param)->translatedFormat('l, d F Y');
        return $value;
    }

    public static function showImage($param)
    {
        $image = Storage::disk('s3')->url($param);
        // Storage::disk('s3')->temporaryUrl($param, '+2 minutes');
        return $image;
    }

    public static function getDistanceBetween($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi')
    {
        $theta = (float)$longitude1 - (float)$longitude2;
        $distance = (sin(deg2rad((float)$latitude1)) * sin(deg2rad((float)$latitude2))) + (cos(deg2rad((float)$latitude1)) * cos(deg2rad((float)$latitude2)) * cos(deg2rad((float)$theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        switch ($unit) {
            case 'Mi':
                break;
            case 'Km':
                $distance = $distance * 1.609344;
        }
        return (round($distance, 2));
    }

    public static function decision($status)
    {
        switch ($status) {
            case 1:
                return 'Diterima';
                break;
            case 2:
                return 'Menunggu Keputusan';
                break;
            default:
                return 'Tidak Diterima';
                break;
        }
    }

    public static function checkPayment()
    {
        $setting_payment = SettingPayment::first();
        $payment_participant = PaymentParticipant::where([
            ['id_participant', Auth::guard('participant')->user()->id],
            ['school_year', session('school_year')],
        ])->first();
        // dd($payment_participant);

        if ($setting_payment == null) {
            $link = true;
        } else {
            if ($setting_payment->payment == 1) {
                $link = empty($payment_participant) ? false : ($payment_participant->payment_status != 1 ? false : true);
            } else {
                $link = true;
            }
        }
        return $link;
    }

    public static function str_random($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public static function no_random($length)
    {
        $pool = '0123456789';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
