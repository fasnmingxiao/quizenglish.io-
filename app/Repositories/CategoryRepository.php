<?php

namespace App\Repositories;

use App\Models\catTopic;
use Illuminate\Support\Facades\Auth;

class CategoryRepository
{
    protected $catTopic;
    function __construct(catTopic $catTopic)
    {
        $this->catTopic = $catTopic;
    }
    function create($attributes)
    {
        return $this->catTopic->create($attributes);
    }
    function showDetail($id)
    {
        return $this->catTopic->where('id', '=', $id)->with('quizCategory')->first();
    }
    function getTopic()
    {
        return $this->catTopic->where('parent_id', 0)->get();
    }
    function checkUnique($name)
    {
        return $this->catTopic->where('name', '=', $name)->first();
    }
    function searchDefault()
    {
        return catTopic::with('quizCategory')
            ->join('category_register', 'cat_topic.id', '=', 'category_register.cat_id')
            ->where('category_register.user_id', '=', Auth::user()->id)
            ->select(
                'cat_topic.*'
            )->get();
    }
    function search($key)
    {
        return $this->catTopic
            ->join('category_register', 'cat_topic.id', '=', 'category_register.cat_id')
            ->where('category_register.user_id', '=', Auth::user()->id)
            ->where('cat_topic.name', 'like', '%' . $key . '%')
            ->where('cat_topic.parent_id', '!=', 0)
            ->select(
                'cat_topic.*'
            )->get();
    }
    public function searchAll($key)
    {
        if ($key == 'none') {
            return catTopic::with('quizCategory')
                ->join('category_register', 'cat_topic.id', '=', 'category_register.cat_id')
                ->where('category_register.user_id', '=', Auth::user()->id)
                ->where('cat_topic.name', 'like', '%' . $key . '%')
                ->select(
                    'cat_topic.*'
                )->get();
        }
        return catTopic::with('quizCategory')
            ->join('category_register', 'cat_topic.id', '=', 'category_register.cat_id')
            ->where('category_register.user_id', '=', Auth::user()->id)
            ->where('cat_topic.name', 'like', '%' . $key . '%')
            ->select(
                'cat_topic.*'
            )->get();
    }
    function getAll()
    {
        return $this->catTopic->get();
    }
    function searchTopic($key)
    {
        if ($key != '' || $key != 0) {
            return  $this->catTopic->where('name', 'like', '%' . $key . '%')->get();
        }
        return $this->catTopic->get();
    }
    function getChildrenTopic($id)
    {
        return $this->catTopic->where('parent_id', $id)->get();
    }
    function update($attributes, $id)
    {
        return $this->catTopic->where('id', $id)->update($attributes);
    }
    function delete($id)
    {
        $item = $this->catTopic->find($id);
        if ($item) {
            return $item->delete();
        }
        return false;
    }
    function deleteTopic($id)
    {
        return $this->catTopic->where('id', '=', $id)->orWhere('parent_id', '=', $id)->delete();
    }
    function get($id)
    {
        return $this->catTopic->find($id);
    }
}
