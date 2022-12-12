<?php

namespace App\Repositories;

use App\Models\QuizCategory;
use Carbon\Carbon;

class QuizCategoryRepository
{
    protected $quizCategory;
    function __construct(QuizCategory $quizCategory)
    {
        $this->quizCategory = $quizCategory;
    }
    function create($attribute)
    {
        return $this->quizCategory->create($attribute);
    }
    function get_cre_today()
    {
        return $this->quizCategory->whereDate('created_at', Carbon::today())->count();
    }
    function getAlloffset($offset, $limit){
        return $this->quizCategory->with(['catTopic' ,'question'])->offset($offset)->limit($limit)->get();
    }
    function getall()
    {
        return $this->quizCategory->all();
    }
    function delete($id)
    {
        $item = $this->quizCategory->find($id);
        if ($item) {
            return $item->delete();
        }
        return false;
    }
    function checkNameUnique($category, $quizCategoryName)
    {
        return $this->quizCategory->where('cat_id', '=', $category)->where('name', '=', $quizCategoryName)->first();
    }
    function paginate()
    {
        return $this->quizCategory->with(['question', 'catTopic'])->paginate(1);
    }
    function get($id)
    {
        return $this->quizCategory->find($id);
    }
    function getAndQuestion($id)
    {
        return $this->quizCategory->where('id', $id)->with('question')->get();
    }
    function update($attributes, $id)
    {
        return $this->quizCategory->where('id', $id)->update($attributes);
    }
    function getByCat($id)
    {
        return $this->quizCategory->where('cat_id', $id)->with('question')->get();
    }
}
