<?php

namespace App\Http\Services\Product;

use App\Repositories\CatRegRepository;
use Illuminate\Support\Facades\Auth;

class CatRegService
{
    protected $catRegRepository;
    function __construct(CatRegRepository $catRegRepository)
    {
        $this->catRegRepository = $catRegRepository;
    }
    function create($id)
    {
        try {
            $this->catRegRepository->create([
                'cat_id' => $id,
                'user_id' => Auth::user()->id
            ]);
            return true;
        } catch (\Exception $error) {
            return false;
            return ['error' => $error->getMessage()];
        }
    }
}
