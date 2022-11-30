<?php

namespace App\Repositories;

use App\Models\Report;


class ReportRepository
{
    protected $report;
    public function __construct(Report $report)
    {
        $this->report = $report;
    }
    public function store($attributes)
    {
        return  $this->report->create($attributes);
    }
    public function get_dashboard()
    {
        return $this->report->limit(5)->with('users')->orderBy('created_at', 'desc')->get();
    }
}
