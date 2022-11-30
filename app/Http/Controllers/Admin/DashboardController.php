<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ConclusionService;
use App\Http\Services\Product\QuizCategoryService;
use App\Http\Services\ReportService;
use App\Http\Services\UserService\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $reportService;
    protected $userService;
    protected $quizService;
    protected $conclusionService;
    public function __construct(ReportService $reportService, UserService $userService, QuizCategoryService $quizService, ConclusionService $conclusionService)
    {
        $this->reportService = $reportService;
        $this->userService = $userService;
        $this->quizService = $quizService;
        $this->conclusionService = $conclusionService;
    }
    function index()
    {
        $user_today = $this->userService->get_reg_today();
        $quiz_today = $this->quizService->get_cre_today();
        $conclusion_today = $this->conclusionService->get_exam_today();
        $users = $this->userService->get_dashboard();
        $report = $this->reportService->get_dashboard();
        return view('admin.dashboard', ['title' => 'Dashboard', 'reports' => $report, 'users' => $users, 'quiz_today' => $quiz_today, 'user_today' => $user_today, 'conclusion_today' => $conclusion_today]);
    }
}
