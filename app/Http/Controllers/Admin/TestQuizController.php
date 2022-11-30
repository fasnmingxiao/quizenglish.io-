<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestQuizController extends Controller
{
    function show($id)
    {
        return view('admin.listTestQuiz', ['title' => 'List Test Quiz']);
    }
}
