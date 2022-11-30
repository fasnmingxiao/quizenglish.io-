<?php

namespace App\Http\Services;

use App\Repositories\ReportRepository;


class ReportService
{
    public $reportRepository;
    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }
    public function store($request, $id)
    {
        return $this->reportRepository->store([
            'user_id' => $id,
            'type_error' => $request->type_error,
            'content' => $request->content
        ]);
    }
    public function get_dashboard()
    {
        return $this->reportRepository->get_dashboard();
    }
}
