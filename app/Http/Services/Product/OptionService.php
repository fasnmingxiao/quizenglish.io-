<?php

namespace App\Http\Services\Product;

use App\Repositories\OptionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OptionService
{
    protected $optionRepository;
    function __construct(OptionRepository $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }
    function store($request)
    {
        try {
            return  $this->optionRepository->create([
                'question_id' => $request->get('idQuestion'),
                'value' => $request->get('option'),
                'iscorrect' =>  $request->get('isCorrect')
            ]);
        } catch (\Exception $error) {
            return ['error' => $error->getMessage()];
        }
    }
    function checkOptionUnique($request)
    {
        return $this->optionRepository->checkOptionUnique($request->option, $request->idQuestion);
    }
    function getByQuestion($id)
    {
        try {
            return  $this->optionRepository->getByQuestion($id);
        } catch (\Exception $error) {
            return ['error' => $error->getMessage()];
        }
    }
    function delete($id)
    {
        return  $this->optionRepository->delete($id);
    }
    function updateIsCorrect($id)
    {
        return $this->optionRepository->updateIsCorrect($id, ['iscorrect' => 0]);
    }
    function update($request)
    {
        try {
            $this->optionRepository->update(['iscorrect' => $request->get('isCorrect'), 'value' => $request->get('option')], $request->get('idOption'));
        } catch (\Exception $error) {
            return false;
        }
    }
}
