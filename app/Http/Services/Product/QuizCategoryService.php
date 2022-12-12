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
    function ajaxGetQuiz($requestall){
        $model = $this->quizCategoryRepository->getAll();
        $recordsTotal = $model->count();
        $datas = $this->quizCategoryRepository->getAlloffset($requestall['start'], $requestall['length']);
         $datas->map(function ($data) {
             $data->cat_name = $data->catTopic->name;
             $data->qty_question = count($data->question);
             $data->times =  config('constants.time_quiz.' . $data->time) .  'minutes';
             $data->action = '<ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
             <li>
                 <a href="#" class="edit edit-button"
                     data-id="'. $data->id . '">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24"
                         height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-edit">
                         <path
                             d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                         </path>
                         <path
                             d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                         </path>
                     </svg></a>
             </li>
             <li>
                 <a href="#" data-id="'. $data->id . '"
                     class="buttonDelete remove">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24"
                         height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-trash-2">
                         <polyline points="3 6 5 6 21 6"></polyline>
                         <path
                             d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                         </path>
                         <line x1="10" y1="11" x2="10"
                             y2="17"></line>
                         <line x1="14" y1="11" x2="14"
                             y2="17"></line>
                     </svg></a>
             </li>
         </ul>';
         });
         return ['result' => $datas, 'recordsTotal' => $recordsTotal , 'recordsFiltered' => $recordsTotal];
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
