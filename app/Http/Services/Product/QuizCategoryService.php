<?php

namespace App\Http\Services\Product;

use App\Repositories\QuizCategoryRepository;
use Illuminate\Support\Facades\Session;

class QuizCategoryService
{
    protected $quizCategoryRepository;
    function __construct(QuizCategoryRepository $quizCategoryRepository)
    {
        $this->quizCategoryRepository = $quizCategoryRepository;
    }
    function getall()
    {
        return $this->quizCategoryRepository->getall();
    }
    function create($request)
    {
        try {
            $this->quizCategoryRepository->create([
                'cat_id' => $request->get('category'),
                'name' => $request->get('quizCategoryName'),
                'description' => $request->get('description'),
                'time' => $request->get('time')
            ]);
            Session::flash('success', 'Add category success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    function get_cre_today()
    {
        return $this->quizCategoryRepository->get_cre_today();
    }
    function checkNameUnique($category, $quizCategoryName)
    {
        return $this->quizCategoryRepository->checkNameUnique($category, $quizCategoryName);
    }
    function paginate()
    {
        return $this->quizCategoryRepository->paginate();
    }

    function delete($id)
    {
        try {
            $this->quizCategoryRepository->delete($id);
            Session::flash('success', 'Delete category success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    function get($id)
    {
        try {
            return  $this->quizCategoryRepository->get($id);
        } catch (\Exception $error) {
            return false;
        }
    }
    function getAndQuestion($id)
    {
        try {
            return  $this->quizCategoryRepository->getAndQuestion($id);
        } catch (\Exception $error) {
            return false;
        }
    }
    function update($request)
    {
        try {
            $this->quizCategoryRepository->update([
                'name' => $request->get('quizCategoryName'),
                'description' => $request->get('description') ?? '',
                'time' => $request->get('time'),
                'cat_id' => $request->topic
            ], $request->get('id'));
            Session::flash('success', 'Update quiz success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    function getByCat($cat_id)
    {
        try {
            return  $this->quizCategoryRepository->getByCat($cat_id);
        } catch (\Exception $error) {
            return false;
        }
    }
}
