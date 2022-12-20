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
    function ajaxGetOption($requestall)
    {
        $model = $this->optionRepository->getAll();
        $recordsTotal = $model->count();
        $datas = $this->optionRepository->getAlloffset($requestall['start'], $requestall['length']);
        $datas->map(function ($data) {
            $data->question_name = $data->question->question;
            $data->action = '<ul class="orderDatatable_actions justify-content-center mb-0 d-flex flex-wrap">
            <li>
                <a href="#" class="edit edit-button"
                    data-id="' . $data->id . '">
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
                <a href="#" data-id="' . $data->id . '"
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
        return ['result' => $datas, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsTotal];
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
            return  $this->optionRepository->update(['iscorrect' => $request->get('isCorrect'), 'value' => $request->get('option')], $request->get('idOption'));
        } catch (\Exception $error) {
            return false;
        }
    }
    function getById($id)
    {
        return $this->optionRepository->getById($id);
    }
}
