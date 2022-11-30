<?php

namespace App\Http\Services\Product;

use App\Repositories\ConclusionRepository;
use Illuminate\Support\Facades\Auth;

class ConclusionService
{
    protected $conclusionRepository;
    function __construct(ConclusionRepository $conclusionRepository)
    {
        $this->conclusionRepository = $conclusionRepository;
    }
    function create($score, $id, $cat_id)
    {
        return    $this->conclusionRepository->create([
            'user_id' => Auth::user()->id,
            'quizcategory_id' => $id,
            'point' => ceil($score),
            'cat_id' => $cat_id
        ]);
    }
    function get()
    {
        return $this->conclusionRepository->get(Auth::user()->id);
    }
    function get_exam_today()
    {
        return $this->conclusionRepository->get_exam_today();
    }
}
