<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\CatRegService;
use App\Http\Services\Product\ConclusionService;
use App\Http\Services\Product\QuestionService;
use App\Http\Services\Product\QuizCategoryService;
use App\Http\Services\UserService\UserService;
use App\Models\option;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use Illuminate\Validation\Rules\Exists;

class MemberQuizController extends Controller
{
    protected $CatRegService;
    protected $user;
    protected $QuizService;
    protected $QuestionSerivce;
    protected $ConclusionService;
    function __construct(QuestionService $QuestionSerivce, CatRegService $catRegService, UserService $user, QuizCategoryService $QuizService, ConclusionService $ConclusionService)
    {
        $this->QuizService = $QuizService;
        $this->user = $user;
        $this->CatRegService = $catRegService;
        $this->QuestionSerivce = $QuestionSerivce;
        $this->ConclusionService = $ConclusionService;
    }
    function index()
    {
        $item =  $this->user->get();
        $listMyQuiz = $item->categories;

        return view('myquiz', ['title' => 'My Quiz', 'listMyQuiz' => $listMyQuiz]);
    }
    function create($id)
    {
        if ($this->CatRegService->create($id)) {
            return redirect()->route('member.myquiz')->with("success", "Add Quiz Success");
        }
        return redirect()->back()->with("error", "Add Quiz Fail");
    }
    function ChooseQuiz($id)
    {

        $listQuiz = $this->QuizService->getByCat($id);
        $listDone = $this->ConclusionService->get();
        return view('ChooseQuiz', ['midBreadCrumb' => 'My Quiz', 'urlBreadCrumb' => url('myquiz'), 'title' => 'Choose Quiz', 'listQuiz' => $listQuiz, 'listDone' => $listDone]);
    }
    function save_answer_insesion($optionid, $questionid)
    {
        $result = [];
        if (Session::exists("answer")) {
            $list = Session::get('answer');
            if (array_key_exists($questionid, $list)) {
                unset($list[$questionid]);
                $result = ['stt' => 'remove'];
            } else {
                $list[$questionid] = $optionid;
                $result = ['stt' => 'add'];
            }
            Session::put('answer', $list);
        } else {
            $result = ['stt' => 'add'];
            Session::put('answer', [$questionid => $optionid]);
        }

        return response()->json($result);
    }
    function result(Request $request)
    {
        $list = $this->QuestionSerivce->getQuestionByQuiz($request->id)->toArray();
        $cat_id = $this->QuizService->get($request->id);
        $cat_id = $cat_id->cat_id;
        $data = '';
        $data .= '     <div class="start_quizz" >';
        $data .=       '<div class="list_quizz" style="margin:0 auto">';
        $score = 0;
        $num_question = count($list);
        $total_1_row = 10 / $num_question;
        foreach ($list as $question) {
            $data .=         "<div class='item'>
                            <div class=' question-title'>" . $question['question'] . "</div>";
            $data .=         '<div class="answer">';
            $numal = 0;
            $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
            $a = $question['id'];
            $b = session()->get("answer.$a");


            foreach ($question['options'] as $option) {
                if (isset($b) && $b == $option['id'] && ($option['iscorrect'] == 1)) {
                    $score += $total_1_row;
                }
                $data .=   '<div class="radiobtn">
                <input type="radio" id="' . $option['id'] . '" name="answer"
                    value="' . $option['id'] . '"';
                if (session()->get("answer.$a") == $option['id']) {
                    $data .= 'checked';
                }
                $data .=   '/>';
                $data .=  '<label ';

                if (session()->get("answer.$a") == $option['id']) {
                    $data .= 'class="member-choose"';
                }
                $data .= '>';


                $data .=  $alphabet[$numal] . '.' . $option['value'];
                if ($option['iscorrect'] == 1) {
                    $data .= '<i class="fas fa-check text-success"></i>';
                } else {
                    $data .= '<i class="fas fa-times text-danger"></i>';
                }
                $data .= '</label>  </div>'; #div radiobtn
                $numal++;
            }
            $data .= '</div>'; #div item
            $data .= '</div>'; #div answer
        }
        $data .= '</div>'; #list_quiz
        $data .= '</div>';
        $total_score = 'You have ' . round($score, 1) . '/10';
        $rs['data'] = $data;
        $rs['score'] = $total_score;
        session()->forget('answer');
        $this->ConclusionService->create(round($score, 1), $request->id, $cat_id);
        return response()->json($rs);
    }
}
