<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    protected $categoryService;
    function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    function index()
    {
        $listCatReg = Auth::user()->categories->toArray();
        return view('topic', ['title' => 'Topic', 'listTopic' => $this->categoryService->getAll(), 'listCatReg' => $listCatReg]);
    }
    function searchTopic($key)
    {
        $listCatReg = Auth::user()->categories->toArray();
        return view('topic', ['title' => 'Topic', 'listTopic' => $this->categoryService->searchTopic($key), 'listCatReg' => $listCatReg]);
    }
    function showDetail($id)
    {
        $data = $this->categoryService->showDetail($id);
        if (Auth::check()) {
            $listCatReg = Auth::user()->categories->toArray();
        } else {
            $listCatReg = '';
        }

        return view('detailCategory', ['title' => $data->name, 'data' => $data, 'listCatReg' => $listCatReg]);
    }
    function search($key)
    {
        if ($key == 'none') {
            $data = $this->categoryService->searchDefault();
            return response()->json($data);
        }
        if ($key != '') {
            $data = $this->categoryService->search($key);
            return response()->json($data);
        }
        return false;
    }
    function searchAll($key)
    {
        if ($key != '') {
            $data = $this->categoryService->searchAll($key);
            return response()->json($data);
        }
        return false;
    }
}
