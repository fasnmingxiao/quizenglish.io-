<?php

namespace App\Http\Controllers;

use App\Http\Services\ReportService;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function store(Request $request)
    {
        $id_user = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'type_error' => [
                'required', Rule::in(array_keys(config('constants.error_report')))
            ]
        ]);
        if (!$validator) {
            return response()->json(['type' => 'error', 'msg' => 'This sprint not found'], 404);
        }
        $report = $this->reportService->store($request, $id_user);

        if ($report) {
            return response()->json(['type' => 'success', 'msg' => 'Send report success. Thank you!']);
        }
        return response()->json(['type' => 'error', 'msg' => 'Send report fail. Try again. Thank you!']);
    }
}
