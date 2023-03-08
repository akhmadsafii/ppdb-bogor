<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Image;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class ImageHelper
{
    public static function upload_asset($request, $name, $path, $data)
    {
        $file = $request->file($name);
        $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $resolution = explode('|', env('SETTING_RESOLUTION'));
        // dd($resolution);
        $thumb = Image::make($file->getRealPath())->resize($resolution[0], $resolution[1], function ($constraint) {
            $constraint->aspectRatio();
        });
        $destination = public_path($path);
        Helper::check_and_make_dir($destination);
        $thumb->save($destination . '/' . $profileImage);
        $data[$name] = $path . '/' . $profileImage;
        return $data;
    }

    public static function upload_asset_drive($request, $name, $path, $data)
    {
        // $asset = ImageHelper::upload_asset($request, $name, $path, $data);
        $file = $request->file($name);
        $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $resolution = explode('|', env('SETTING_RESOLUTION'));
        $thumb = Image::make($file->getRealPath())->resize($resolution[0], $resolution[1], function ($constraint) {
            $constraint->aspectRatio();
        });
        $destination = public_path($path);
        Helper::check_and_make_dir($destination);
        $thumb->save($destination . '/' . $profileImage);
        $data[$name] = $path . '/' . $profileImage;
        Gdrive::put($data[$name], $file);
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


    public static function upload_drive($request, $name, $path, $data)
    {
        $asset = ImageHelper::upload_asset($request, $name, $path, $data);
        $dir_path = public_path() . '/' . $asset[$name];
        Gdrive::put($asset[$name], $dir_path);
        File::delete($asset[$name]);
        return $asset;
    }


    public static function show_drive($image)
    {
        $data = Gdrive::get($image);
        return response($data->file, 200)
            ->header('Content-Type', $data->ext);
    }

    public static function upload_multiple_asset_drive($file, $path)
    {
        $profileImage = date('YmdHis') . Helper::str_random(5) . "." . $file->getClientOriginalExtension();
        $resolution = explode('|', env('SETTING_RESOLUTION'));
        $thumb = Image::make($file->getRealPath())->resize($resolution[0], $resolution[1], function ($constraint) {
            $constraint->aspectRatio();
        });
        $destination = public_path($path);
        Helper::check_and_make_dir($destination);
        $thumb->save($destination . '/' . $profileImage);
        $data = $path . '/' . $profileImage;
        Gdrive::put($data, $file);
        return $data;
    }
}
