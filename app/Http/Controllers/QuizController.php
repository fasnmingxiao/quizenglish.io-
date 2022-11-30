<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    protected $question;
    function __construct(QuestionService $question)
    {
        $this->question = $question;
    }
    function start($id)
    {
        $listQuestion =  $this->question->getQuestionByQuiz($id)->toArray();
        shuffle($listQuestion);
        return view('startQuiz', ['title' => $listQuestion[0]['quizcategories']['name'], 'listQuestion' => $listQuestion, 'time' => config('constants.time_quiz.' . $listQuestion[0]['quizcategories']['time'])]);
    }
    function getById($id)
    {
        $a = Session::get("answer.$id");
        $quiz = $this->question->getById($id);
        $data = [];
        $html = "";
        $data['question'] = $quiz['question'];
        $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $count = 0;
        foreach ($quiz->options as $option) {
            $html .= "<div class='radiobtn'>";
            $html .= "<input onclick='optionClick(" . $quiz['id'] . "," . $option['id'] . ")' type='radio' id='" . $option['id'] . "' name='answer' value='" . $option['id'] . "' ";
            if ($a == $option['id']) {
                $html .= " checked />";
            } else {
                $html .= "/>";
            }
            $html .= "<label for=" . $option['id'] . ">" . $alphabet[$count] . "." . $option['value'] . "</label>";
            $html .= '</div>';
            $count++;
        }
        $data['html'] = $html;
        return response()->json($data);
    }
}
