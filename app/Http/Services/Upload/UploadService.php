<?php

namespace App\Http\Services\Upload;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class UploadService
{
    function store($request)
    {
        try {
            if ($request->hasFile('file')) {

                $name = rand() . '.' . strtolower($request->file('file')->getClientOriginalName());
                $publicPath = public_path('storage/images/users/');
                //path save img 80
                Image::make($request->file('file'))->resize(80, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($publicPath . '80/' . $name);
                //path save img 300
                Image::make($request->file('file'))->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($publicPath . '300/' . $name);
                //path save original img
                Image::make($request->file('file'))->save($publicPath . 'original/' . $name);
                return $name;
            }
        } catch (\Exception $error) {
            return $error;
        }
    }
    function remove($request)
    {
        if (!empty($request->get('image'))) {
            $image_path_80 = public_path("/images/users/80/" . $request->get('image'));
            $image_path_300 = public_path("/images/users/300/" . $request->get('image'));
            $image_path_original = public_path("/images/users/original/" . $request->get('image'));

            if (File::exists($image_path_80)) {
                File::delete($image_path_80);
            }
            if (File::exists($image_path_300)) {
                File::delete($image_path_300);
            }
            if (File::exists($image_path_original)) {
                File::delete($image_path_original);
            }
            return true;
        }
        return false;
    }
    function storeThumbCategory($request)
    {
        try {
            if ($request->hasFile('file')) {
                $name = rand() . '.' . strtolower($request->file('file')->getClientOriginalName());
                $publicPath = public_path('storage/images/category/');
                File::makeDirectory($publicPath, 0777, true, true);
                //path save img 300
                Image::make($request->file('file'))->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($publicPath . $name);
                return $name;
            }
        } catch (\Exception $error) {
            return $error;
        }
    }
}
