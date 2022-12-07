<?php

namespace App\Http\Controllers;

use App\Http\Services\Upload\UploadService;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $upload;
    function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }
    function store(Request $request)
    {

        $url =  $this->upload->store($request);
        if ($url != false) {
            return response()->json([
                'error' => false,
                'url' => $url
            ]);
        }
        return response()->json(['error' => true]);
    }
    function remove(Request $request)
    {
        $result =  $this->upload->remove($request);
        if ($result != false) {
            return response()->json([
                'error' => false,
                'url' => 'template/img/user_default.png'
            ]);
        }
        return response()->json(['error' => true]);
    }
    function uploadCkfinder(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_EXTENSION);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $publicPath = public_path('storage/images/ckeditor/upload/');
            File::makeDirectory($publicPath, 0777, true, true);
            $request->file('upload')->storeAs('/public/images/ckeditor/upload', $fileName);
            $url = asset('storage/images/ckeditor/upload/' . $fileName);
            return response()->json(['filename' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
