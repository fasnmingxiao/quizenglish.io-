<?php

namespace App\Http\Services\Product;

use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuestionService
{
    protected $questionRepository;
    function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }
    public function store($request)
    {
        try {
            return  $this->questionRepository->create([
                'quizcategory_id' => $request->get('quizcategory_id'),
                'question' => $request->get('question')
            ]);
        } catch (\Exception $error) {
            return ['error' => $error->getMessage()];
        }
    }
    public function get($id)
    {
        $datas = $this->questionRepository->get($id);
        $option_html = '';
        foreach ($datas->options as $option) {
            $option_html .= '
         <div class="form-group" id="form-'. $option->id .'">
             <div class="row">
                 <div class="col-6">
                     <input type="hidden" class="form-control" name="idOption-' . $option->id . '" value="' . $option->id . '">
                     <div class="form-group form-element-textarea" style="margin-bottom: 0;">
                         <textarea class="form-control" id="option-' . $option->id . '" name="option" style="height:50px;">' . $option->value . '</textarea>
                     </div>
                 </div>
                 <div class="col-2" style="align-self: center;">
                    <div class="checkbox-theme-default custom-checkbox ">
                        <input class="checkbox" type="checkbox" id="check-' . $option->id . '" ' . ($option->iscorrect ? 'checked' : '') . '>
                        <label for="check-' . $option->id . '">
                            <span class="checkbox-text">
                                Correct
                            </span>
                        </label>
                    </div>
                 </div>
                 <div class="col-2" style="align-self: center;">
                     <button class="btn btn-primary btn-default btn-squared btn-transparent-primary btn-update-option" data-id=' . $option->id . '>Update
                     </button>
                 </div>
                 <div class="col-2" style="align-self: center;">
                     <button class="btn btn-danger btn-default btn-squared btn-transparent-danger btn-delete-option" data-id=' . $option->id . '>Del
                     </button>
                 </div>
             </div>
         </div>
';
        }
        $datas->option = $option_html;
        return $datas;
    }
    public function getAll()
    {
        return $this->questionRepository->getAll();
    }
    public function paginate($request)
    {
        $filter = $request->get('filter');
        $quiz_id = $request->get('quiz');
        return $this->questionRepository->paginate($quiz_id, $filter);
    }
    public function update($request)
    {
        try {
            $this->questionRepository->update([
                'question' => $request->get('question'),
                'quizcategory_id' => $request->get('quizcategory_id'),
            ], $request->get('id'));
            Session::flash('success', 'Update question success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    public function delete($id)
    {
        try {
            $this->questionRepository->delete($id);
            Session::flash('success', 'Delete question success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    public function getQuestionByQuiz($id)
    {
        try {
            return $this->questionRepository->getQuestionByQuiz($id);
        } catch (\Exception $error) {
            return ['error' => $error->getMessage()];
        }
    }
    public function getById($id)
    {
        try {
            return $this->questionRepository->getById($id);
        } catch (\Exception $error) {
            return ['error' => $error->getMessage()];
        }
    }
}
