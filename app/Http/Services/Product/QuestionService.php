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
        return $this->questionRepository->get($id);
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
