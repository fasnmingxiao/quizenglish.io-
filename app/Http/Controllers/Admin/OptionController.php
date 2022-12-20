<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\OptionService;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    protected $optionSerivce;
    function __construct(OptionService $optionSerivce)
    {
        $this->optionSerivce = $optionSerivce;
    }
    function store(Request $request)
    {
        if ($request->get('isCorrect') == 1) {
            $this->optionSerivce->updateIsCorrect($request->get('idQuestion'));
        }
        $option = $this->optionSerivce->store($request);
        return response()->json($option);
    }
    function ajaxGetOption(Request $request)
    {
        $data = $this->optionSerivce->ajaxGetOption($request->all());
        return response()->json($data);
    }
    function new()
    {
        return view('admin.inc.tr_add_new_option')->render();
    }
    function checkOptionUnique(Request $request)
    {
        $data = $this->optionSerivce->checkOptionUnique($request);
        if ($data != null) {
            $sms = ['rs' => 'true'];
            return response()->json($sms);
        }
        $sms = ['rs' => 'false'];

        return response()->json($sms);
    }
    function getByQuestion(Request $request, $id)
    {
        $options = $this->optionSerivce->getByQuestion($id);
        if ($request->ajax()) {
            return view('admin.modal_detail_question', compact('options'))->render();
        }
        return response()->json($options);
    }
    function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $options = $this->optionSerivce->getByQuestion($id);
            return view('admin.inc.modal_edit_option', compact('options'))->render();
        }
    }
    function delete($id)
    {
        $options = $this->optionSerivce->delete($id);
        if ($options) {
            $result = ['error' => false, 'msg' => 'Delete option success!'];
        }
        $result = ['error' => true, 'msg' => 'Delte option failer'];
        return response()->json($result);
    }
    function storeAjax(Request $request)
    {
        if ($request->get('isCorrect') == 1) {
            $this->optionSerivce->updateIsCorrect($request->get('idQuestion'));
        }
        $option = $this->optionSerivce->store($request);
        return response()->json($option);
    }
    function update(Request $request)
    {
        if ($request->get('isCorrect') == 1) {
            $this->optionSerivce->updateIsCorrect($request->get('idQuestion'));
        }
        $option = $this->optionSerivce->update($request);
        return response()->json($option);
    }
    function ajaxGetOptionByid($id)
    {
        $data = $this->optionSerivce->getById($id);
        return response()->json($data);
    }
}
