<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\QuestionService;
use App\Http\Services\Product\QuizCategoryService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $quizCategoryService;
    protected $questionService;
    function __construct(QuizCategoryService $quizCategoryService, QuestionService $questionService)
    {
        $this->quizCategoryService = $quizCategoryService;
        $this->questionService = $questionService;
    }
    function index(Request $request)
    {
        $data = $this->questionService->paginate($request);
        $noHasCorrect = 0;
        $noOptions = 0;
        if ($request->get('filter') == 'no-correct-answer') {
            $noHasCorrect = $data->total();
            $noOptions = 0;
        } else if ($request->get('filter') == 'no-options') {
            $noHasCorrect = 0;
            $noOptions = $data->total();
        }
        $questions = $this->questionService->getALl();
        if ($request->get('filter') == '' || $request->get('filter') == 'all') {
            foreach ($questions as $item) {
                if ($item->options->count() == false) {
                    $noOptions++;
                } else {
                    if (array_search(1, array_column($item->options->toArray(), 'iscorrect'))) {
                        $noHasCorrect++;
                    }
                }
            }
        }
        if ($request->ajax()) {
            $quizs =  $this->quizCategoryService->getall();
            return view('admin.inc.table_question', compact('data', 'quizs', 'noOptions', 'noHasCorrect'))->render();
        }
        return view('admin.question_db', ['title' => 'Questions & Options', 'data' => $data, 'quizs' =>  $this->quizCategoryService->getall(), 'noHasCorrect' => $noHasCorrect, 'noOptions' => $noOptions]);
    }
    function create($id)
    {
        return view('admin.addQuestion', ['title' => 'Add question', 'cat' => $this->quizCategoryService->get($id)]);
    }
    function update(Request $request)
    {
        $this->questionService->update($request);
        return redirect()->back();
    }
    function getOne(Request $request, $id)
    {
        if ($request->ajax()) {
            $item = $this->questionService->get($id);
            return response()->json($item);
        }
    }

    function store(Request $request)
    {
        $question = $this->questionService->store($request);
        return response()->json($question);
    }
    function delete(Request $request, $id)
    {
        $data = $this->questionService->delete($id);
        if ($request->ajax()) {
            return response()->json($data);
        }
        return redirect()->back();
    }
    function getQuestionByQuiz($id)
    {
        $item = $this->questionService->getQuestionByQuiz($id);

        return response()->json($item);
    }
}
