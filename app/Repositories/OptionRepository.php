<?php

namespace App\Repositories;

use App\Models\option;


class OptionRepository
{
    protected $option;
    function __construct(option $option)
    {
        $this->option = $option;
    }
    function create($attributes)
    {
        return $this->option->create($attributes);
    }
    function getAll()
    {
        return $this->option->with(['question'])->get();
    }
    function getAlloffset($offset, $limit)
    {
        return $this->option->with(['question'])->offset($offset)->limit($limit)->get();
    }
    function checkOptionUnique($option, $idQuestion)
    {
        return $this->option->where('question_id', '=', $idQuestion)->where('value', '=', $option)->first();
    }
    function getById($id)
    {
        return $this->option->find($id);
    }
    function getByQuestion($id)
    {
        return $this->option->where('question_id', $id)->with('question')->get();
    }
    function delete($id)
    {
        $option = $this->option->find($id);
        return $option->delete();
    }
    function updateIsCorrect($id, $attributes)
    {
        return $this->option->where('question_id', $id)->where('iscorrect', 1)->update($attributes);;
    }
    function update($attributes, $id)
    {
        return $this->option->where('id', $id)->update($attributes);
    }
}
