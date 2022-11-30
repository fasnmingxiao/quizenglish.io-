<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\CategoryService;
use App\Http\Services\Product\QuizCategoryService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class QuizzCategoryController extends Controller
{
    protected $categoryService;
    protected $quizCategoryService;
    function __construct(CategoryService $categoryService, QuizCategoryService $quizCategoryService)
    {
        $this->quizCategoryService = $quizCategoryService;
        $this->categoryService = $categoryService;
    }
    function index()
    {
        return view('admin.addQuizCategory', [
            'title' => 'Add Quiz Category',
            'listTopic' => $this->categoryService->getTopic(),
            'listTime' => config('constants.time_quiz')
        ]);
    }
    function quiz_db()
    {
        return view('admin.quiz_db', ['title' => 'Quiz', 'listTopic' => $this->categoryService->getAll(), 'quizs' => $this->quizCategoryService->paginate(),]);
    }
    function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['time' => Rule::in(array_keys(config('constants.time_quiz')))]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $category = $request->category;
        $name = $request->quizCategoryName;
        $rs = $this->quizCategoryService->checkNameUnique($category, $name);
        if ($rs != null) {
            return redirect()->back()->with('error', 'Quiz category title have exsists');
        }
        $this->quizCategoryService->create($request);
        return redirect()->back();
    }
    function delete($id)
    {
        $this->quizCategoryService->delete($id);
        return redirect()->back();
    }
    function show($id)
    {
        $item = $this->categoryService->get($id);
        return view('admin.listTestQuiz', ['title' => $item->name, 'listItem' => $item]);
    }
    function get($id)
    {
        $item = $this->quizCategoryService->get($id);
        return response()->json($item);
    }
    function getQuestion($id)
    {
        $item = $this->quizCategoryService->get($id);
        return response()->json($item->question);
    }
    function update(Request $request)
    {
        $validator = Validator::make($request->all(), ['time' => Rule::in(array_keys(config('constants.time_quiz')))]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $this->quizCategoryService->update($request);
        return redirect()->back();
    }
}
