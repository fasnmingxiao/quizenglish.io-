<?php

namespace App\Http\Controllers;

use App\Http\Services\Upload\UploadService;
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
}
