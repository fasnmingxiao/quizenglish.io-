<?php

namespace App\Repositories;

use App\Models\CategoryReg;


class CatRegRepository
{
    protected $catReg;
    function __construct(CategoryReg $catReg)
    {
        $this->catReg = $catReg;
    }
    function create($attributes)
    {
        return $this->catReg->create($attributes);
    }
}
