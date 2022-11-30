<?php

namespace App\Repositories;

use App\Models\question;


class QuestionRepository
{
    protected $question;
    function __construct(question $question)
    {
        $this->question = $question;
    }
    function create($attributes)
    {
        return $this->question->create($attributes);
    }
    function get($id)
    {
        return $this->question->find($id);
    }
    function getAll()
    {
        return $this->question->with('options')->get();
    }
    function paginate($quiz_id, $filter)
    {
        $query = $this->question->query()->with('options')->join('quizcategory', 'questions.quizcategory_id', '=', 'quizcategory.id');
        if ($quiz_id != '') {
            $query->where('questions.quizcategory_id', '=', $quiz_id);
        }
        if ($filter == '' || $filter == 'all') {
            return $query->orderBy('quizcategory.name', 'ASC')
                ->orderBy('questions.question', 'ASC')
                ->select('questions.*',  'quizcategory.name')
                ->paginate(5);
        }
        if ($filter == 'no-correct-answer') {
            return $query->whereNotIn('questions.id', function ($q) {
                $q->select('options.question_id')->from('options')->where('iscorrect', '=', 1);
            })->whereNotIn('questions.id', function ($q) {
                $q->select('questions.id')->from('questions')->leftJoin('options', 'questions.id', '=', 'options.question_id')->whereNull('options.question_id');
            })
                ->orderBy('quizcategory.name', 'ASC')
                ->orderBy('questions.question', 'ASC')
                ->select('questions.*',  'quizcategory.name')
                ->paginate(5);
        }
        if ($filter == 'no-options') {
            return   $query->leftJoin('options', 'questions.id', '=', 'options.question_id')->whereNull('options.question_id')->orderBy('quizcategory.name', 'ASC')
                ->orderBy('questions.question', 'ASC')
                ->select('questions.*',  'quizcategory.name')
                ->paginate(5);
        }
        // return $this->question->with('options')
        // ->join('options', 'questions.id', '=', 'options.question_id')
        //     ->join('quizcategory', 'questions.quizcategory_id', '=', 'quizcategory.id')
        //     ->orderBy('quizcategory.name', 'ASC')
        //     ->orderBy('questions.question', 'ASC')
        //     ->select('questions.*',  'quizcategory.name')
        //     ->paginate(5);
    }

    function no_options_paginate()
    {
    }
    function update($attributes, $id)
    {
        return $this->question->where('id', '=', $id)->update($attributes);
    }
    function delete($id)
    {
        $item = $this->question->find($id);
        if ($item) {
            return $item->delete();
        }
        return false;
    }
    function getQuestionByQuiz($id)
    {
        return $this->question->where('quizcategory_id', $id)->with('options', 'quizcategories')->get();
    }
    function getById($id)
    {
        return $this->question->with('options')->find($id);
    }
}
